<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import for file storage

class TrainerController extends Controller
{
    public function trainers()
    {
        $academies = Academy::all();  // Get all academies
        $trainers = Trainer::where('isDeleted', false)->get();
        return view('admin.trainers.index', compact('trainers', 'academies'));
    }

    public function createTrainer()
    {
        $academies = Academy::all();  // Get all academies to assign to a trainer
        return view('admin.trainers.create', compact('academies'));
    }

    public function storeTrainer(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:trainers,email',
            'password' => 'required|min:6',
            'academy_id' => 'required|exists:academies,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate image file
        ]);

        $trainer = new Trainer();
        $trainer->name = $validated['name'];
        $trainer->email = $validated['email'];
        $trainer->password = bcrypt($validated['password']);
        $trainer->academy_id = $validated['academy_id'];

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $uniqueFileName = uniqid() . '_' . $originalFileName;
            $imagePath = $request->file('image')->move(public_path('assets/trainer'), $uniqueFileName);
            $imagePath = 'trainer/' . $uniqueFileName;
            $trainer->image = $imagePath; // Store relative path in the database
        }

        $trainer->save();

        return redirect()->route('admin.trainers')->with('success', 'Trainer created successfully');
    }

    public function editTrainer($id)
    {
        $trainer = Trainer::findOrFail($id);
        $academies = Academy::all();
        return view('admin.trainers.edit', compact('trainer', 'academies'));
    }

    public function updateTrainer(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:trainers,email,' . $id,
            'password' => 'nullable|min:6',
            'academy_id' => 'required|exists:academies,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate image file
        ]);

        $trainer = Trainer::findOrFail($id);
        $trainer->name = $validated['name'];
        $trainer->email = $validated['email'];
        if ($validated['password']) {
            $trainer->password = bcrypt($validated['password']);
        }
        $trainer->academy_id = $validated['academy_id'];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($trainer->image) {
                Storage::disk('public')->delete($trainer->image);
            }
                $originalFileName = $request->file('image')->getClientOriginalName();
                $uniqueFileName = uniqid() . '_' . $originalFileName;
                $imagePath = $request->file('image')->move(public_path('assets/trainer'), $uniqueFileName);
                $imagePath = 'trainer/' . $uniqueFileName;
                $trainer->image = $imagePath; // Store relative path in the database
        }

        $trainer->save();

        return redirect()->route('admin.trainers')->with('success', 'Trainer updated successfully');
    }

    public function deleteTrainer($id)
    {
        $trainer = Trainer::findOrFail($id);
        $trainer->isDeleted = true;
        $trainer->save();

        return redirect()->route('admin.trainers')->with('success', 'Trainer deleted successfully');
    }

    public function toggleTrainerActive(Trainer $trainer)
    {
        $trainer->active = !$trainer->active;
        $trainer->save();

        return back()->with('success', 'Trainer status updated');
    }
}
