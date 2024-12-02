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


class AcademyController extends Controller
{

    public function academies()
    {
        $academies = Academy::where('isDeleted', false)->get();
        // Fetch academies with related managers
    // Fetch all managers
        return view('admin.academies.index', compact('academies'));
    }

    public function storeAcademy(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
          
        ]);

        Academy::create($request->only(['name', 'address']));

        return redirect()->route('admin.academies');
    }

    public function deleteAcademy($id)
    {
        // Find the academy by ID
        $academy = Academy::findOrFail($id);

        // Set the 'isDeleted' flag to true to soft delete the academy
        $academy->isDeleted = true;
        $academy->save();

        // Redirect back to the academy management page
        return redirect()->route('admin.academies')->with('success', 'Academy has been deleted successfully.');
    }


    public function editAcademy($id)
    {
        $academy = Academy::findOrFail($id);
   
        return view('admin.academies.edit', compact('academy'));
    }

    public function updateAcademy(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
           
        ]);

        $academy = Academy::findOrFail($id);
        $academy->update($request->only(['name', 'address']));

        return redirect()->route('admin.academies');
    }




  

}
