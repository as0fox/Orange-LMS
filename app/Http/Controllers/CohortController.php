<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Models\Academy;
use App\Models\Manager;
use App\Models\Cohort;
use App\Models\Trainer;
use App\Models\Trainee;
use App\Models\JobCoach;
use Illuminate\Support\Facades\Auth;

class CohortController extends Controller
{

  

    public function cohorts()
    {
        $user=Auth::user();
        if($user->type =="admin"){
        $cohorts = Cohort::all();
        $academies = Academy::all();
        }elseif($user->type =="manager")
        {
        $cohorts = Cohort::where('academy_id', $user->academy_id)->get();
        $academies = Academy::where('id', $user->academy_id)->get();
        }




        return view('admin.cohorts.index', compact('cohorts', 'academies', 'user'));
    }

    public function createCohort()
    {
        $academies = Academy::all();
        return view('admin.cohorts.create', compact('academies'));
    }

    public function storeCohort(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'academy_id' => 'required|exists:academies,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'active' => 'required|boolean',
        ]);
    
     
        Cohort::create($request->only(['name', 'academy_id', 'start_date', 'end_date', 'active']));
    
        return redirect()->route('admin.cohorts')->with('success', 'Cohort created successfully!');
    }
    

    public function editCohort($id)
    {
        $cohort = Cohort::findOrFail($id);
        $academies = Academy::all();
        return view('admin.cohorts.edit', compact('cohort', 'academies'));
    }

    public function updateCohort(Request $request, $id)
    {
        $cohort = Cohort::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'academy_id' => 'required|exists:academies,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'active' => 'required|boolean',
        ]);

        $cohort->update($request->only(['name', 'academy_id', 'start_date', 'end_date', 'active']));

        return redirect()->route('admin.cohorts')->with('success', 'Cohort updated successfully!');
    }

    public function deleteCohort($id)
    {
        $cohort = Cohort::findOrFail($id);
        $cohort->update(['isDeleted' => true]); // Soft delete

        return redirect()->route('admin.cohorts')->with('success', 'Cohort deleted successfully!');
    }

    public function toggleCohortActive(Cohort $cohort)
    {
       
        $cohort->active = !$cohort->active;
   
        $cohort->save();

        return redirect()->back()->with('success', 'Cohort status updated successfully.');
    }
    
    public function getCohorts($academyId)
    {
         // Fetch cohorts related to the selected academy
         $cohorts = Cohort::where('academy_id', $academyId)->get();

            return response()->json($cohorts);
   }
}