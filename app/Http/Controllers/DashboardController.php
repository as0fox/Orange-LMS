<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\Cohort;
use App\Models\Assignment;
use App\Models\Absence;
use App\Models\Trainee;
use App\Models\Technology;
use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Centralized data fetching
        $academyId = Auth::user()->academy_id;

        // Fetch all data
        $data = [
            'academies' => Academy::where('isDeleted', false)->get(),
            'cohorts' => Cohort::where('isDeleted', false)
                                ->when($academyId, function ($query) use ($academyId) {
                                    $query->where('academy_id', $academyId);
                                })->get(),
            'assignments' => Assignment::where('is_deleted', false)
                                        ->when($academyId, function ($query) use ($academyId) {
                                            $query->where('academy_id', $academyId);
                                        })->get(),
            'absences' => Absence::all(),
            'trainees' => Trainee::where('active', true)
                                 ->when($academyId, function ($query) use ($academyId) {
                                     $query->where('academy_id', $academyId);
                                 })->get(),
            'technologies' => Technology::where('isDeleted', false)->get(),
            'announcements' => Announcement::when($academyId, function ($query) use ($academyId) {
                $query->where('academy_id', $academyId);
            })->orderBy('created_at', 'desc')->get(),
        ];

        // Transform data for dashboard metrics
        $dashboardData = $this->prepareDashboardData($data, $academyId);

        // Pass data to view
        return view('admin.dashboard.index', $dashboardData);
    }

    private function prepareDashboardData($data, $academyId)
    {
        $now = Carbon::now();

        // Calculate dashboard metrics
        return [
            'totalAcademies' => $data['academies']->count(),
            'activeAcademies' => $data['academies']->where('active', true)->count(),
            'totalCohorts' => $data['cohorts']->count(),
            'activeCohorts' => $data['cohorts']->where('active', true)->count(),
            'totalAssignments' => $data['assignments']->count(),
            'pendingAssignments' => $data['assignments']->where('deadline', '>', $now)->count(),
            'totalAbsences' => $data['absences']->count(),
            'pendingAbsences' => $data['absences']->where('status', 'Pending')->count(),
            'totalStudents' => $data['trainees']->count(),
            'graduatedStudents' => $data['trainees']->filter(function ($trainee) use ($now) {
                return optional($trainee->cohort)->end_date < $now;
            })->count(),
            'averageCompletionRate' => $this->getAverageCompletionRate($data['cohorts']),
            'newEnrollmentsThisMonth' => $data['trainees']->where('created_at', '>=', $now->startOfMonth())->count(),
            'upcomingAssignments' => $data['assignments']->where('deadline', '>', $now)
                                                          ->sortBy('deadline')->values(),
            'technologies' => $data['technologies'],
            'cohortPerformance' => $this->calculateCohortPerformance($data['cohorts']),
            'announcements' => $data['announcements']->take(5),
            'chartLabels' => $this->getChartLabels(),
            'chartDatasets' => $this->getChartDatasets(),
            'skillDistribution' => $this->getSkillDistribution($data['trainees']),
        ];
    }

    private function calculateCohortPerformance($cohorts)
    {
        return $cohorts->map(function ($cohort) {
            return [
                'name' => $cohort->name,
                'startDate' => $cohort->start_date,
                'completionRate' => $this->calculateCompletionRate($cohort),
                'averageScore' => $this->calculateAverageScore($cohort),
            ];
        });
    }

    private function getAverageCompletionRate($cohorts)
    {
        // Example logic for average completion rate
        $completionRates = $cohorts->map(function ($cohort) {
            return $this->calculateCompletionRate($cohort);
        });

        return $completionRates->avg() ?? 0;
    }

    private function calculateCompletionRate($cohort)
    {
        // Logic to calculate cohort completion rate
        return rand(70, 100); // Replace with actual calculation
    }

    private function calculateAverageScore($cohort)
    {
        // Logic to calculate cohort average score
        return rand(60, 90); // Replace with actual calculation
    }

    private function getChartLabels()
    {
        return ['Jan', 'Feb', 'Mar', 'Apr']; // Example labels
    }

    private function getChartDatasets()
    {
        return [
            [
                'label' => 'Completion Rate',
                'data' => [70, 80, 85, 90], // Example data
                'borderColor' => '#4bc0c0',
                'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
            ],
        ];
    }

    private function getSkillDistribution($trainees)
    {
        // Example skill distribution logic
        return [
            ['skill' => 'PHP', 'beginner' => 10, 'intermediate' => 15, 'advanced' => 5],
            ['skill' => 'JavaScript', 'beginner' => 12, 'intermediate' => 14, 'advanced' => 8],
        ];
    }
}
