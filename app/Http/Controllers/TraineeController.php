<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Cohort;
use App\Models\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TraineeController extends Controller
{
    public function trainees()
    {
        $user = Auth::user();
        $isAdmin = $user->type === 'admin';  // Check if the user is an admin
        $academyId = $user->academy_id;  // Get the user's academy ID
    
        // Get cohorts based on the user's role
        $cohorts = $isAdmin ? Cohort::all() : Cohort::where('academy_id', $academyId)->get();
    
        // Get academies based on the user's role
        $academies = $isAdmin ? Academy::all() : Academy::where('id', $academyId)->get();
    
        // Fetch trainees based on the user's role
        if ($isAdmin) {
            // Admin can see all trainees
            $trainees = Trainee::with('cohort', 'academy')->get();
        } else {
            // Non-admins can only see trainees from their assigned academy
            $trainees = Trainee::where('academy_id', $academyId)
                ->with('academy', 'cohort')
                ->get();
        }
    
        return view('admin.trainees.index', compact('trainees', 'academies', 'cohorts', 'user'));
    }
    
    public function storeTrainee(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:trainees,email',
            'password' => 'nullable|string|min:8',
            'address' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cohort_id' => 'nullable|exists:cohorts,id',
            'academy_id' => 'nullable|exists:academies,id',
            'gender' => 'nullable|string|in:male,female',
            'birthday' => 'nullable|date',
            'specialization' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255', // Validate type field
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $uniqueFileName = uniqid() . '_' . $originalFileName;
            $imagePath = $request->file('image')->move(public_path('assets/trainees'), $uniqueFileName);
            $imagePath = 'trainees/' . $uniqueFileName;
        }
    
        Trainee::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $imagePath,
            'cohort_id' => $request->cohort_id,
            'academy_id' => $request->academy_id,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'specialization' => $request->specialization,
            'type' => $request->type ?? 'trainee', // Default to 'trainee'
        ]);
    
        return redirect()->route('admin.trainees')->with('success', 'Trainee created successfully!');
    }
    public function updateTrainee(Request $request, $id)
{
    $trainee = Trainee::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:trainees,email,' . $trainee->id,
        'password' => 'nullable|string|min:8',
        'address' => 'nullable|string|max:100',
        'phone' => 'nullable|string|max:15',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'cohort_id' => 'nullable|exists:cohorts,id',
        'academy_id' => 'nullable|exists:academies,id',
        'gender' => 'nullable|string|in:male,female',
        'birthday' => 'nullable|date',
        'specialization' => 'nullable|string|max:255',
        'type' => 'nullable|string|max:255',
    ]);

    // Handle Image Upload
    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($trainee->image && file_exists(public_path('assets/' . $trainee->image))) {
            unlink(public_path('assets/' . $trainee->image));
        }

        $file = $request->file('image');
        $originalFileName = $file->getClientOriginalName();
        $uniqueFileName = uniqid() . '_' . $originalFileName;

        $file->move(public_path('assets/trainees'), $uniqueFileName);
        $validated['image'] = 'trainees/' . $uniqueFileName;
    }

    // Encrypt the password only if provided
    if ($request->filled('password')) {
        $validated['password'] = bcrypt($validated['password']);
    } else {
        unset($validated['password']);
    }

    $trainee->update(array_merge($validated, [
        'type' => $request->type ?? $trainee->type,
    ]));

    return redirect()->route('admin.trainees')->with('success', 'Trainee updated successfully.');
}



    public function deleteTrainee($id)
    {
        $trainee = Trainee::findOrFail($id);
        $trainee->isDeleted = true; // Mark as deleted without removing the data
        $trainee->save();

        return redirect()->route('admin.trainees')->with('success', 'Trainee deleted successfully.');
    }

    public function toggleTraineeActive(Trainee $trainee)
    {
        $trainee->active = !$trainee->active; // Toggle the active status
        $trainee->save();

        return back()->with('success', 'Trainee status updated.');
    }


}