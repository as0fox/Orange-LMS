<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Trainee;
use App\Models\Academy;
use App\Models\Cohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AbsenceController extends Controller
{
    // Display the list of absences with filtering by academy and cohort
    public function index(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->type === 'admin';  // Check if the user is an admin
        $academyId = $user->academy_id;  // Get the user's academy ID
    
        // Retrieve filter parameters (academy and cohort)
        $academy_id = $request->get('academy');
        $cohort_id = $request->get('cohort');
    
        // Build the query based on filters for trainees
        $query = Trainee::withCount('absences');  // Dynamically count absences for each trainee
    
        // If user is not admin, filter by the user's academy
        if (!$isAdmin) {
            $query->where('academy_id', $academyId);  // Limit to the user's academy
        }
    
        // Apply additional filters if set in the request
        if ($academy_id) {
            $query->where('academy_id', $academy_id);
        }
    
        if ($cohort_id) {
            $query->where('cohort_id', $cohort_id);
        }
    
        // Get filtered trainees
        $trainees = $query->get();
    
        // Get all absences for the second table (associating trainees)
        $absences = Absence::with('trainee')->get();
    
        // Get academies and cohorts based on the user's role
        $academies = $isAdmin ? Academy::all() : Academy::where('id', $academyId)->get();
        $cohorts = $isAdmin ? Cohort::all() : Cohort::where('academy_id', $academyId)->get();
    
        // Pass the trainees, academies, and cohorts to the view
        return view('admin.absences.index', compact('trainees', 'academies', 'cohorts', 'absences', 'user'));
    }
    
    // Store a new absence
    public function store(Request $request)
    {
       

        // Validate input
        $request->validate([
            'trainee_id' => 'required|exists:trainees,id',
            'absence_type' => 'required|string', // This ensures the absence type is valid
            'reason' => 'nullable|string', // Reason is optional for Unexcused and Delay absences
        ]);
        
      
        
    
        // Find the trainee
        $trainee = Trainee::findOrFail($request->trainee_id);
    
        // Fetch the cohort of the trainee to get max_absence
        $cohort = $trainee->cohort; // Assuming the trainee has a cohort relationship
    
        if ($cohort) {
            // Get max_absence from the cohort
            $maxAbsence = $cohort->max_absence;
    
            // Check if the trainee has reached the max absence
            if ($trainee->absences()->count() >= $maxAbsence) {
                Absence::create([
                    'trainee_id' => $trainee->id,
                    'absence_type' => $request->absence_type, // Save the absence type
                    'reason' => $request->absence_type === 'Excused' ? $request->reason : null, // Only store the reason if it's 'Excused'
                    'status' => 'Pending',
                    'requested_at' => now(), // Set the requested_at timestamp
                ]);
                return redirect()->route('absences.index')
                                 ->with('error', 'This trainee has reached the maximum absence limit.');
            }
        }
    
        // Create a new absence record
        Absence::create([
            'trainee_id' => $trainee->id,
            'absence_type' => $request->absence_type, // Ensure the selected absence type is being saved
            'reason' => $request->absence_type === 'Excused' ? $request->reason : null, // Store reason only if 'Excused'
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
    // Validate input
    $request->validate([
        'absence_type' => 'required|string',
        'reason' => 'nullable|string',
        'status' => 'required|string',
    ]);

    // Find the absence record
    $absence = Absence::findOrFail($id);

    // Update the absence details
    $absence->update([
        'absence_type' => $request->absence_type,
        'reason' => $request->absence_type === 'Excused' ? $request->reason : null,
        'status' => $request->status,
    ]);

    return redirect()->route('absences.index')->with('success', 'Absence updated successfully.');
}

}