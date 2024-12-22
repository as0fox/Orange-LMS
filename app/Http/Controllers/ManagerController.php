<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Academy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
class ManagerController extends Controller
{
    public function managers()
    {
        $user=Auth::user();
        $academies = Academy::all();
        $managers = Manager::all();
        return view('admin.managers.index', compact('managers' , 'academies', 'user'));
    }

    public function toggleActive(Manager $manager)
    {
       
        $manager->active = !$manager->active;
        $manager->save();

        return redirect()->back()->with('success', 'Manager status updated successfully.');
    }

    public function storeManager(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:managers,email',
            'password' => 'required|min:8',
            'academy_id' => 'required|exists:academies,id', // Validate academy_id
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $uniqueFileName = uniqid() . '_' . $originalFileName;
            $imagePath = $request->file('image')->move(public_path('assets/managers'), $uniqueFileName);
            $imagePath = 'managers/' . $uniqueFileName;
        }

        Manager::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'academy_id' => $request->academy_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.managers')->with('success', 'Manager created successfully!');
    }

    public function editManager($id)
    {
        $manager = Manager::findOrFail($id);
        $academies = Academy::all(); // Get all academies for selection
        return view('admin.managers.edit', compact('manager', 'academies'));
    }

    public function updateManager(Request $request, $id)
{
    $manager = Manager::findOrFail($id);

    // Validate the request
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:managers,email,' . $id,
        'password' => 'nullable|min:6',
        'academy_id' => 'required|exists:academies,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Update the manager's details
    $manager->name = $request->name;
    $manager->email = $request->email;
    $manager->academy_id = $request->academy_id; // Update academy_id

    // Handle password update (if provided)
    if ($request->password) {
        $manager->password = bcrypt($request->password);
    }

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($manager->image) {
            Storage::disk('public')->delete($manager->image);
        }

        // Upload the new image
        $originalFileName = $request->file('image')->getClientOriginalName();
        $uniqueFileName = uniqid() . '_' . $originalFileName;
        $imagePath = $request->file('image')->move(public_path('assets/managers'), $uniqueFileName);
        $imagePath = 'managers/' . $uniqueFileName;

        // Store the relative path in the database
        $manager->image = $imagePath;
    }

    // Save the updated manager
    $manager->save();

    // Redirect with success message
    return redirect()->route('admin.managers')->with('success', 'Manager updated successfully!');
}


    public function destroyManager($id)
    {
        $manager = Manager::findOrFail($id);
        $manager->delete();

        return redirect()->route('admin.managers')->with('success', 'Manager deleted successfully!');
    }
}