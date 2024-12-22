<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Cohort;
use App\Models\Technology;
use App\Models\Academy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AssignmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->type === 'admin';
        $hasAcademyAccess = in_array($user->type, ['manager', 'trainer', 'job_coach']);
        $academyId = $user->academy_id;
    
      
        $academies = $isAdmin ? Academy::all() : ($hasAcademyAccess ? Academy::where('id', $academyId)->get() : []);
        $cohorts = $isAdmin ? Cohort::all() : ($hasAcademyAccess ? Cohort::where('academy_id', $academyId)->get() : []);
        $assignments = $isAdmin ? Assignment::all() : ($hasAcademyAccess ? Assignment::where('academy_id', $academyId)->get() : []);
        $technologies = Technology::all();
    
        return view('admin.assignments.index', compact('assignments', 'cohorts', 'technologies', 'academies', 'user'));
    }
    
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:100',
                'description' => 'required|string',
                'deadline' => 'required|date',
                'technology_id' => 'required|exists:technologies,id',
                'academy_id' => 'required|exists:academies,id',
                'cohort_id' => 'required|exists:cohorts,id',
                'attachment' => 'nullable|file|mimes:pdf,doc,docx,zip|max:5120',
                'active' => 'nullable|boolean',
            ]);

            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment')->store('assignments', 'public');
            }

            Assignment::create([
                'title' => $request->title,
                'description' => $request->description,
                'deadline' => $request->deadline,
                'technology_id' => $request->technology_id,
                'academy_id' => $request->academy_id,
                'cohort_id' => $request->cohort_id,
                'attachment' => $attachmentPath,
                'active' => $request->active ?? false,
            ]);

            return redirect()->route('assignments.index')->with('success', 'Assignment created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create assignment.');
        }
    }

    public function create()
    {
        $cohorts = Cohort::all();
        $technologies = Technology::all();
        $academies = Academy::all();
        return view('admin.assignments.create', compact('cohorts', 'technologies', 'academies'));
    }

    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        $cohorts = Cohort::all();
        $technologies = Technology::all();
        $academies = Academy::all();
        return view('admin.assignments.edit', compact('assignment', 'cohorts', 'technologies', 'academies'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'deadline' => 'required|date',
            'technology_id' => 'required|exists:technologies,id',
            'academy_id' => 'required|exists:academies,id',
            'cohort_id' => 'required|exists:cohorts,id',
            'active' => 'nullable|boolean', 
        ]);

        $assignment = Assignment::findOrFail($id);
        $assignment->update($request->all());

        return redirect()->route('assignments.index')->with('success', 'Assignment updated successfully.');
    }

    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->delete();

        return redirect()->route('assignments.index')->with('success', 'Assignment deleted successfully.');
    }
}
