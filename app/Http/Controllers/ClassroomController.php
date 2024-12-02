<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Cohort;
use App\Models\Trainer;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    // Display the list of classrooms
    public function index()
    {
        $classrooms = Classroom::with(['cohort', 'trainer'])->get();  // Eager load related models
        $cohorts = Cohort::all();  // Assuming you want to display all cohorts for classroom creation
        $trainers = Trainer::all();  // Assuming you want to display all trainers for classroom creation

        return view('admin.classrooms.index', compact('classrooms', 'cohorts', 'trainers'));
    }



    // Toggle active/inactive status
    public function toggleActive($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->active = !$classroom->active;
        $classroom->save();

        return back()->with('success', 'Classroom status updated');
    }

    // "Delete" a classroom (set is_deleted to true)
    public function delete($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->is_deleted = true;  // Mark as deleted instead of using actual deletion
        $classroom->save();

        return back()->with('success', 'Classroom marked as deleted');
    }

    // Restore a deleted classroom (set is_deleted to false)
    public function restore($id)
    {
        $classroom = Classroom::where('is_deleted', true)->findOrFail($id);
        $classroom->is_deleted = false;  // Restore by setting is_deleted to false
        $classroom->save();

        return back()->with('success', 'Classroom restored successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:1',
            'cohort_id' => 'required|exists:cohorts,id',
            'trainer_id' => 'required|exists:trainers,id',
        ]);

        Classroom::create($request->only('name', 'cohort_id', 'trainer_id'));

        return redirect()->route('admin.classrooms')->with('success', 'Classroom added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:1',
            'cohort_id' => 'required|exists:cohorts,id',
            'trainer_id' => 'required|exists:trainers,id',
        ]);

        $classroom = Classroom::findOrFail($id);
        $classroom->update($request->only('name', 'cohort_id', 'trainer_id'));

        return redirect()->route('admin.classrooms')->with('success', 'Classroom updated successfully!');
    }


}
