<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Cohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AbsenceRuleController extends Controller
{
    
    // Display a list of cohorts with max_absence
    public function index(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->type === 'admin';
        $hasAcademyAccess = in_array($user->type, ['manager', 'job-coach']); // Check if user is manager or job_coach
        $academyId = $user->academy_id;
    
        // Fetch cohorts based on user role
        $cohorts = Cohort::with('academy')
            ->when($isAdmin, function ($query) {
                // Admin has access to all cohorts
                return $query;
            })
            ->when($hasAcademyAccess, function ($query) use ($academyId) {
                // Manager and Job Coach have access to cohorts in their academy only
                return $query->where('academy_id', $academyId);
            })
            ->when($request->academy, function ($query) use ($request) {
                // Filter by academy if passed in the request
                return $query->where('academy_id', $request->academy);
            })
            ->get();
    
        // Fetch academies based on user role
        $academies = $isAdmin ? Academy::all() : Academy::where('id', $academyId)->get();
    
        return view('admin.absence_rules.index', compact('cohorts', 'academies', 'user'));
    }
    
    
    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'max_absence' => 'required|integer|min:1',
        ]);
    
        // Find the cohort by ID
        $cohort = Cohort::findOrFail($id);
    
        // Update the max_absence value
        $cohort->max_absence = $request->max_absence;
        $cohort->save(); // Save the changes to the database
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Max Absence updated successfully.');
    }
    
    
    

    // Show the form to edit max_absence for a cohort
    public function edit($id)
    {
        $cohort = Cohort::findOrFail($id);
        return view('admin.absence_rules.edit', compact('cohort'));
    }

 
}
