<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Cohort;
use App\Models\Trainee;
use Illuminate\Http\Request;

class TraineeController extends Controller
{
    public function trainees()
    {
        $cohorts = Cohort::all();
        $academies = Academy::all(); // Fetch academies
        $trainees = Trainee::with('cohort', 'academy')->get(); // Updated relation to academy
        return view('admin.trainees.index', compact('trainees', 'academies' , 'cohorts')); // Pass academies to the view
    }

    public function storeTrainee(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:trainees,email',
            'password' => 'required|string|min:8',
            'address' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'cohort_id' => 'nullable|exists:cohorts,id',
            'academy_id' => 'nullable|exists:academies,id', // Validate academy_id
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
            'password' => bcrypt($request->password), // Encrypt password
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $imagePath,
            'cohort_id' => $request->cohort_id,
            'academy_id' => $request->academy_id, // Store academy_id
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
            'academy_id' => 'nullable|exists:academies,id', // Validate academy_id
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('trainees', 'public');
        }

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $trainee->update($validated);

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
