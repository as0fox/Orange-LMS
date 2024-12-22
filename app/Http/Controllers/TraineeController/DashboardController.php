<?php
namespace App\Http\Controllers\TraineeController;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request; // Add this line

use Illuminate\Support\Facades\Auth;
use App\Models\Cohort;
use App\Models\Manager;
use App\Models\Academy;
use App\Models\Trainer;
use App\Models\Assignment;
use App\Models\JobCoach;
use App\Models\Absence;
use App\Models\Technology;
use App\Models\Announcement;
use App\Models\TechnoToCohort;
use App\Models\SubmittedAssignment;



class DashboardController extends Controller
{
    // Display the list of classrooms
    public function index()
    {
        $user=Auth::User();
        $cohort=Cohort::Where('id',$user->cohort_id)->first();
        $technoToCohort = TechnoToCohort::where('cohort_id', $cohort->id)->get();
        $technologies = Technology::whereIn('id', $technoToCohort->pluck('technology_id'))->get();
        $announcements=Announcement::Where('cohort_id',$cohort->id)->get();

        return view('trainee.dashboard.index', compact('user' ,'cohort','announcements' ,'technologies'));
    }
    
    public function Announcements()
    {
        $user=Auth::User();
        $cohort=Cohort::Where('id',$user->cohort_id)->first();
        $technoToCohort = TechnoToCohort::where('cohort_id', $cohort->id)->get();
        $technologies = Technology::whereIn('id', $technoToCohort->pluck('technology_id'))->get();
        $announcements=Announcement::Where('cohort_id',$cohort->id)->get();

        return view('trainee.Announcements.index', compact('user' ,'cohort','announcements' ,'technologies'));
    }


    public function assignment()
    {
        $user = Auth::user();
        $cohort = Cohort::where('id', $user->cohort_id)->first();
        $technoToCohort = TechnoToCohort::where('cohort_id', $cohort->id)->get();
        $technologies = Technology::whereIn('id', $technoToCohort->pluck('technology_id'))->get();
        $announcements = Announcement::where('cohort_id', $cohort->id)->get();
        
        $assignments = Assignment::where([
            ['cohort_id', $cohort->id],
            ['active', true],
            ['is_deleted', false]
        ])->with('technology')->get();

        return view('trainee.assignments.index', compact(
            'user',
            'cohort',
            'announcements',
            'technologies',
            'assignments'
        ));
    
    }

    
    public function submit(Request $request)
    {

        $user=Auth::user();

        $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'submission_link' => 'required|url',
            'comments' => 'nullable|string|max:500'
        ]);
    
        $assignment = Assignment::findOrFail($request->assignment_id);
    
        // Check if deadline has passed
        if (Carbon::parse($assignment->deadline)->isPast()) {
            return redirect()->back()->with('error', 'Assignment deadline has passed');
        }
    
        // Check if already submitted
        $existingSubmission = SubmittedAssignment::where([
            'assignment_id' => $request->assignment_id,
            'trainee_id' => $user->id
        ])->first();
    
        if ($existingSubmission) {
            // Update existing submission
            $existingSubmission->update([
                'submission_link' => $request->submission_link,
                'comments' => $request->comments,
                'status' => 'submitted',
                'submitted_at' => now()
            ]);
    
            return redirect()->back()->with('success', 'Your assignment submission has been updated successfully.');
        }
    
        // Create new submission
        SubmittedAssignment::create([
            'assignment_id' => $request->assignment_id,
            'trainee_id' => $user->id,
            'submission_link' => $request->submission_link,
            'comments' => $request->comments,
            'status' => 'submitted',
            'submitted_at' => now()
        ]);
    
        return redirect()->back()->with('success', 'Assignment submitted successfully.');
    }
    

    public function cohort()
    {

        $user=Auth::User();
        $cohort=Cohort::Where('id',$user->cohort_id)->first();
        $manager=Manager::Where('academy_id',$cohort->academy_id)->first();
        $trainers=Trainer::Where('academy_id',$cohort->academy_id)->get();
        $jobcoachs=JobCoach::Where('academy_id',$cohort->academy_id)->get();
        $technoToCohort = TechnoToCohort::where('cohort_id', $cohort->id)->get();
        $technologies = Technology::whereIn('id', $technoToCohort->pluck('technology_id'))->get();

        return view('trainee.mycohort.index', compact('user' , 'cohort', 'technologies','trainers','manager' ,'jobcoachs'));
       
    }
    public function technology()
    {

        $user=Auth::User();
        $cohort=Cohort::Where('id',$user->cohort_id)->first();
        $technoToCohort = TechnoToCohort::where('cohort_id', $cohort->id)->get();
        $technologies = Technology::whereIn('id', $technoToCohort->pluck('technology_id'))->get();
    
        return view('trainee.Technologies.index', compact('user' , 'cohort', 'technologies'));
       
    }



}
