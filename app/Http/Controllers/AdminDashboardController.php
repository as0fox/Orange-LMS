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

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        // Check user role
        $isAdmin = $user->type === 'admin';
        $hasAcademyAccess = in_array($user->type, ['manager', 'trainer', 'job-coach']); // Generalized for roles
        $academyId = $user->academy_id;
    
        // Fetch data based on user role
        $data = [
            'academies' => $isAdmin ? Academy::where('Active', true)->get() : ($hasAcademyAccess ? Academy::where('id', $academyId)->get() : []),
            'cohorts' => Cohort::where('Active', true)
                                ->when(!$isAdmin, function ($query) use ($academyId) {
                                    $query->where('academy_id', $academyId);
                                })->get(),
            'assignments' => Assignment::where('is_deleted', false)
                                        ->when(!$isAdmin, function ($query) use ($academyId) {
                                            $query->where('academy_id', $academyId);
                                        })->get(),
            'absences' => $isAdmin ? Absence::all() : ($hasAcademyAccess ? Absence::whereHas('trainee', function ($query) use ($academyId) {
                $query->where('academy_id', $academyId);
            })->get() : []),
            'trainees' => Trainee::where('active', true)
                                 ->when(!$isAdmin, function ($query) use ($academyId) {
                                     $query->where('academy_id', $academyId);
                                 })->get(),
            'technologies' => Technology::where('isDeleted', false)->get(),
            'announcements' => Announcement::when(!$isAdmin, function ($query) use ($academyId) {
                $query->whereHas('cohort', function ($subQuery) use ($academyId) {
                    $subQuery->where('academy_id', $academyId);
                });
            })->orderBy('created_at', 'desc')->get(),
        ];
    
        // Get notifications
        $notifications = $this->getRecentNotifications($data);
    
        // Transform data for dashboard metrics
        $dashboardData = $this->prepareDashboardData($data, $academyId);
    
        // Add gender distribution data to dashboardData
        $genderDistribution = $this->getGenderDistribution($data['trainees']);
        $dashboardData['genderDistribution'] = $genderDistribution;
    
        // Add cohort-wise gender distribution
        $cohortGenderDistribution = $this->getCohortGenderDistribution($data['cohorts']);
        $dashboardData['cohortGenderDistribution'] = $cohortGenderDistribution;

        // Add cohort progress data for line chart
        $cohortProgress = $this->getCohortProgress($data['cohorts']);
        $dashboardData['cohortProgress'] = $cohortProgress;
    
        return view('admin.dashboard.index', array_merge(
            $dashboardData, 
            ['notifications' => $notifications, 'user' => $user, 'genderDistribution' => $genderDistribution , 'cohortProgress' => $cohortProgress]
        ));
    }

    private function getGenderDistribution($trainees)
    {
        $user = Auth::user();
        $isAdmin = $user->type === 'admin';
        $hasAcademyAccess = in_array($user->type, ['manager', 'trainer', 'job-coach']); // Generalized for roles
        if ($isAdmin) {
            $genderCounts = $trainees->groupBy('gender')->map->count();
        } else {
            $genderCounts = $trainees->where('academy_id', $user->academy_id)
                ->whereIn('gender', ['male', 'female'])
                ->groupBy('gender')
                ->map->count();
        }
        return [
            'labels' => ['male', 'female'],
            'datasets' => [
                [
                    'data' => [
                        $genderCounts->get('male', 0),
                        $genderCounts->get('female', 0),
                    ],
                    'backgroundColor' => ['#36A2EB', '#FF6384'], // Blue for male, Pink for female
                ],
            ],
        ];
    }

    private function getCohortGenderDistribution($cohorts)
    {
        $cohortGenderData = [];

        foreach ($cohorts as $cohort) {
            $maleCount = $cohort->trainees->where('gender', 'male')->count();
            $femaleCount = $cohort->trainees->where('gender', 'female')->count();

            $cohortGenderData[] = [
                'cohort' => $cohort->name,
                'male' => $maleCount,
                'female' => $femaleCount,
            ];
        }

        return $cohortGenderData;
    }

    private function getRecentNotifications($data)
    {
        // Initialize notifications collection
        $notifications = collect();

        // Add Absence notifications
        $notifications = $notifications->merge(
            $data['absences']->where('status', 'Pending')->map(function ($absence) {
                return [
                    'type' => 'Absence',
                    'title' => 'Absence request for ' . $absence->trainee->name,
                    'created_at' => $absence->created_at,
                    'icon' => 'calendar-times'
                ];
            })
        );

        // Add Assignment notifications
        $notifications = $notifications->merge(
            $data['assignments']->where('deadline', '>', Carbon::now())->map(function ($assignment) {
                return [
                    'type' => 'Assignment',
                    'title' => 'Assignment due: ' . $assignment->title,
                    'created_at' => $assignment->created_at,
                    'icon' => 'tasks'
                ];
            })
        );

        // Add New Technology notifications
        $notifications = $notifications->merge(
            $data['technologies']->where('created_at', '>', Carbon::now()->subDays(30))->map(function ($technology) {
                return [
                    'type' => 'Technology',
                    'title' => 'New Technology Added: ' . $technology->name,
                    'created_at' => $technology->created_at,
                    'icon' => 'laptop-code'
                ];
            })
        );

        // Add Announcement notifications
        $notifications = $notifications->merge(
            $data['announcements']->take(5)->map(function ($announcement) {
                return [
                    'type' => 'Announcement',
                    'title' => 'New Announcement: ' . $announcement->title,
                    'created_at' => $announcement->created_at,
                    'icon' => 'bullhorn'
                ];
            })
        );

        // Add New Cohort notifications
        $notifications = $notifications->merge(
            $data['cohorts']->where('created_at', '>', Carbon::now()->subDays(30))->map(function ($cohort) {
                return [
                    'type' => 'Cohort',
                    'title' => 'New Cohort Created: ' . $cohort->name,
                    'created_at' => $cohort->created_at,
                    'icon' => 'users'
                ];
            })
        );

        // Add New Trainee notifications
        $notifications = $notifications->merge(
            $data['trainees']->where('created_at', '>', Carbon::now()->subDays(30))->map(function ($trainee) {
                return [
                    'type' => 'Enrollment',
                    'title' => 'New Trainee Enrolled: ' . $trainee->name,
                    'created_at' => $trainee->created_at,
                    'icon' => 'user-plus'
                ];
            })
        );

        // Limit and sort notifications
        return $notifications->sortByDesc('created_at')->take(10);
    }

    public function getCohortProgress($cohorts)
    {
        $labels = [];
        $progressData = [];
        $currentDate = Carbon::now();  // Get the current date using Carbon

        foreach ($cohorts as $cohort) {
            $labels[] = $cohort->name; // Cohort names or any time-related labels

            // Ensure the cohort has both start and end dates, and convert them to Carbon instances
            if ($cohort->start_date && $cohort->end_date) {
                $startDate = Carbon::parse($cohort->start_date); // Convert start_date to Carbon instance
                $endDate = Carbon::parse($cohort->end_date); // Convert end_date to Carbon instance

                // Calculate the total duration of the cohort in days
                $totalDuration = $startDate->diffInDays($endDate);

                // Calculate the elapsed time from the start date to the current date
                $elapsedTime = $startDate->diffInDays($currentDate);

                // Calculate the progress percentage (between 0 and 100)
                $progressPercentage = ($elapsedTime / $totalDuration) * 100;

                // Ensure that the progress percentage doesn't exceed 100%
                $progressPercentage = min($progressPercentage, 100);

                // Add the progress data to the array
                $progressData[] = round($progressPercentage); // Round to the nearest integer for display
            } else {
                // If there's no start or end date, default to 0% progress
                $progressData[] = 0;
            }
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Cohort Progress',
                    'data' => $progressData,
                    'borderColor' => '#4e73df',
                    'backgroundColor' => 'rgba(78, 115, 223, 0.2)',
                    'fill' => true,
                ]
            ]
        ];
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
            ['skill' => 'PHP', 'count' => 10],
            ['skill' => 'Java', 'count' => 12],
            ['skill' => 'React', 'count' => 8],
        ];
    }
}
