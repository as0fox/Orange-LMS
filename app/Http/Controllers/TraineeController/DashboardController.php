<?php
namespace App\Http\Controllers\TraineeController;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request; // Add this line

use Illuminate\Support\Facades\Auth;
use App\Models\Cohort;
use App\Models\Manager;
use App\Models\Item;
use App\Models\Academy;
use App\Models\Trainer;
use App\Models\Assignment;
use App\Models\JobCoach;
use App\Models\Absence;
use App\Models\Trainee;
use App\Models\Technology;
use App\Models\Announcement;
use App\Models\TechnoToCohort;
use App\Models\SubmittedAssignment;



class DashboardController extends Controller
{

    public function index()
    {
        $user = Auth::user(); // Get the logged-in user
        $cohort = Cohort::where('id', $user->cohort_id)->first();
    
        // Fetch cohort technologies
        $technoToCohort = TechnoToCohort::where('cohort_id', $cohort->id)->get();
        $technologies = Technology::whereIn('id', $technoToCohort->pluck('technology_id'))->get();
    
        // Fetch active announcements for the cohort
        $announcements = Announcement::where('cohort_id', $cohort->id)
            ->where('is_active', 1)
            ->where('date', '>=', now())
            ->get();
    
        // Fetch absence data dynamically
        $absences = $user->absences()
        ->selectRaw("
            COUNT(CASE WHEN absence_type = 'Excused' THEN 1 ELSE NULL END) AS excused_absences,
            COUNT(CASE WHEN absence_type = 'Unexcused' THEN 1 ELSE NULL END) AS unexcused_absences,
            SUM(
                CASE 
                    WHEN absence_type = 'Delay' AND TIME(requested_at) > '09:00:00' 
                    THEN TIMESTAMPDIFF(MINUTE, MAKETIME(9, 0, 0), TIME(requested_at)) 
                    ELSE 0 
                END
            ) AS total_delay_minutes,
            COUNT(
                CASE 
                    WHEN absence_type = 'Delay' AND TIME(requested_at) > '09:00:00' 
                    THEN 1 
                    ELSE NULL 
                END
            ) AS total_delay_days
        ")
        ->first();
    
        // Ensure total_delay_minutes and total_delay_days are set
        $totalDelayMinutes = $absences->total_delay_minutes ?? 0;
        $totalDelayDays = $absences->total_delay_days ?? 0;   //2
    
       
        $finalDelayMinutes = $totalDelayMinutes ;
    
        // Ensure final delay is not negative
        if ($finalDelayMinutes < 0) {
            $finalDelayMinutes = 0;
        }

        // Convert final delay to hours and minutes for display
        $finalDelayHours = floor($finalDelayMinutes / 60);
        $remainingMinutes = $finalDelayMinutes % 60;
   
        return view('trainee.dashboard.index', compact(
            'user',
            'cohort',
            'announcements',
            'technologies',
            'absences',
            'finalDelayMinutes',
            'finalDelayHours',
            'remainingMinutes'
        ));
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
        $technoToCohorts = TechnoToCohort::where('cohort_id', $cohort->id)->get();
        $technologies = Technology::whereIn('id', $technoToCohorts->pluck('technology_id'))->get();

        return view('trainee.mycohort.index', compact('user' , 'cohort', 'technoToCohorts','technologies','trainers','manager' ,'jobcoachs'));
       
    }

    public function items($technology_id, $user_id)
    {
        // Find the user (trainee)
        $user = Trainee::findOrFail($user_id);
    
        // Get the cohort ID from the user
        $cohort_id = $user->cohort_id;
    
        // Retrieve items linked to the given technology and the user's cohort
        $items = Item::whereHas('technoToCohort', function ($query) use ($technology_id, $cohort_id) {
            $query->where('technology_id', $technology_id)
                  ->where('cohort_id', $cohort_id);
        })->get();
    
        // Find the technology details
        $technology = Technology::findOrFail($technology_id);
    
        // Pass the data to the view
        return view('trainee.technologies.items', compact('user', 'technology', 'items'));
    }
    

    public function technology()
    {

        $user=Auth::User();
        $cohort=Cohort::Where('id',$user->cohort_id)->first();
        $technoToCohorts = TechnoToCohort::where('cohort_id', $cohort->id)->get();
        $technologies = Technology::whereIn('id', $technoToCohorts->pluck('technology_id'))->get();
    
        return view('trainee.Technologies.index', compact('user' , 'cohort', 'technoToCohorts'));
       
    }



}
