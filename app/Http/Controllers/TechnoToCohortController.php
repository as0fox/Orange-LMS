<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Cohort;
use App\Models\Technology;
use App\Models\TechnoToCohort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class TechnoToCohortController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->type === 'admin';
        $hasAcademyAccess = in_array($user->type, ['manager', 'trainer', 'job_coach']); // Generalized role check
        $academyId = $user->academy_id;
    
        // Fetch academies based on user role
        $academies = $isAdmin ? Academy::all() : ($hasAcademyAccess ? Academy::where('id', $academyId)->get() : []);
    
        // Fetch cohorts based on user role and selected academy
        $cohorts = Cohort::when($request->academy_id, function ($query) use ($request) {
            return $query->where('academy_id', $request->academy_id);
        })
        ->when(!$isAdmin, function ($query) use ($academyId, $hasAcademyAccess) {
            if ($hasAcademyAccess) {
                $query->where('academy_id', $academyId);
            }
        })->get();
    
        // Fetch technologies
        $technologies = Technology::all();
    
        // Selected academy and cohort IDs
        $selectedAcademyId = $request->academy_id;
        $selectedCohortId = $request->cohort_id;
    
        // Fetch already assigned technologies for the selected cohort
        $selectedTechnologies = collect();
        if ($selectedCohortId) {
            $selectedTechnologies = TechnoToCohort::where('cohort_id', $selectedCohortId)
                ->pluck('technology_id');
        }
    
        return view('admin.techno_to_cohort.index', [
            'academies' => $academies,
            'cohorts' => $cohorts,
            'technologies' => $technologies,
            'selectedTechnologies' => $selectedTechnologies,
            'selectedAcademyId' => $selectedAcademyId,
            'selectedCohortId' => $selectedCohortId,
            'user' => $user,
        ]);
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'academy_id' => 'required|exists:academies,id',
            'cohort_id' => 'required|exists:cohorts,id',
            'technologies' => 'required|array',
        ]);

        // Remove existing relations
        TechnoToCohort::where('cohort_id', $request->cohort_id)->delete();

        // Add new technologies
        foreach ($request->technologies as $technology_id) {
            TechnoToCohort::create([
                'cohort_id' => $request->cohort_id,
                'technology_id' => $technology_id,
            ]);
        }

        return redirect()->route('techno_to_cohort.index', [
            'academy_id' => $request->academy_id,
            'cohort_id' => $request->cohort_id,
        ])->with('success', 'Technologies assigned successfully.');
    }

    // Method to fetch cohorts via AJAX
    public function getCohorts($academyId)
    {
        $cohorts = Cohort::where('academy_id', $academyId)->get();
        return response()->json($cohorts);
    }
}
