<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Trainee;
use App\Models\Academy;
use App\Models\Cohort;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
    // Display the list of absences with filtering by academy and cohort
    public function index(Request $request)
    {
        // Retrieve filter parameters (academy and cohort)
        $academy_id = $request->get('academy');
        $cohort_id = $request->get('cohort');

        // Build the query based on filters for trainees
        $query = Trainee::withCount('absences'); // Dynamically count absences for each trainee

        if ($academy_id) {
            $query->where('academy_id', $academy_id);
        }

        if ($cohort_id) {
            $query->where('cohort_id', $cohort_id);
        }

        // Get filtered trainees
        $trainees = $query->get();

        // Get all absences for the second table
        $absences = Absence::with('trainee')->get();

        // Pass the trainees, academies, and cohorts to the view
        $academies = Academy::all();
        $cohorts = Cohort::all();

        return view('admin.absences.index', compact('trainees', 'academies', 'cohorts', 'absences'));
    }

    // Store a new absence
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'trainee_id' => 'required|exists:trainees,id',
            'reason' => 'required|string', // Make sure the reason is provided
        ]);

        // Find the trainee
        $trainee = Trainee::findOrFail($request->trainee_id);

        // Check if the trainee already has 6 absences
        if ($trainee->absences()->count() >= 6) {
            return redirect()->route('absences.index')
                             ->with('error', 'This trainee has reached the maximum absence limit.');
        }

        // Create a new absence record
        Absence::create([
            'trainee_id' => $trainee->id,
            'reason' => $request->reason,  // Use the provided reason
            'status' => 'Pending',
            'requested_at' => now(), // Set the requested_at timestamp
        ]);

        return redirect()->route('absences.index')
                         ->with('success', 'Absence successfully marked for the trainee.');
    }

    // Update the absence (edit reason or status)
    public function edit($id)
    {
        $absence = Absence::findOrFail($id);
        return view('admin.absences.edit', compact('absence'));
    }

    // Update the absence record in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
            'reason' => 'nullable|string',
        ]);

        $absence = Absence::findOrFail($id);
        $absence->update($request->all());

        return redirect()->route('absences.index')
                         ->with('success', 'Absence status updated.');
    }
}
