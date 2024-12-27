<?php $dashboard_active = 'active'; ?>
@include('admin.partials.header')

<div class="container-fluid px-4">
    <div class="row g-4">
        <!-- Main Content Column -->
        <div class="col-lg-9">
            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-lg-4">
                    <div class="stat-card p-3 bg-white shadow-sm rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-black mb-2">Total Academies</h6>
                                <h3 class="mb-0">{{ $totalAcademies }}</h3>
                                <small class="text-success">Active: {{ $activeAcademies }}</small>
                            </div>
                            <div class="stat-icon text-primary">
                                <i class="fas fa-school fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="stat-card p-3 bg-white shadow-sm rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-black mb-2">Total Cohorts</h6>
                                <h3 class="mb-0">{{ $totalCohorts }}</h3>
                                <small class="text-success">Active: {{ $activeCohorts }}</small>
                            </div>
                            <div class="stat-icon text-success">
                                <i class="fas fa-users fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="stat-card p-3 bg-white shadow-sm rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-black mb-2">Assignments</h6>
                                <h3 class="mb-0">{{ $totalAssignments }}</h3>
                                <small class="text-success">Pending: {{ $pendingAssignments }}</small>
                            </div>
                            <div class="stat-icon text-info">
                                <i class="fas fa-tasks fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="stat-card p-3 bg-white shadow-sm rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-black mb-2">Absence Requests</h6>
                                <h3 class="mb-0">{{ $totalAbsences }}</h3>
                                <small class="text-warning">Pending: {{ $pendingAbsences }}</small>
                            </div>
                            <div class="stat-icon text-warning">
                                <i class="fas fa-calendar-times fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="stat-card p-3 bg-white shadow-sm rounded">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-black mb-2">Total Students</h6>
                                <h3 class="mb-0">{{ $totalStudents }}</h3>
                                <small class="text-success">Graduated: {{ $graduatedStudents }}</small>
                            </div>
                            <div class="stat-icon text-danger">
                                <i class="fas fa-graduation-cap fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>

            <!-- Gender Distribution Chart -->
            <div class="row g-4 mb-4">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h5 class="card-title mb-0">Gender Distribution</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title mb-0">Cohort Progress</h5>
            </div>
            <div class="card-body">
                <canvas id="cohortProgressChart"></canvas>
            </div>
        </div>
    </div>
            </div>
<!-- Cohort Progress Chart -->
<div class="row g-4 mb-4">
   
</div>
            <!-- Rest of the previous content remains the same -->
            <!-- Additional Sections -->
            <div class="row g-4">
                <!-- Upcoming Assignments -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h5 class="card-title mb-0">Upcoming Assignments</h5>
                        </div>
                        <div class="card-body">
                            @foreach($upcomingAssignments as $assignment)
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                <div>
                                    <h6 class="mb-1">{{ $assignment['title'] }}</h6>
                                    <small class="text-muted">{{ $assignment['description'] }}</small>
                                </div>
                                <span class="badge bg-orange-primary">{{ $assignment['deadline'] }} days left</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Technologies Overview -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h5 class="card-title mb-0">Technologies Overview</h5>
                        </div>
                        <div class="card-body">
                            @foreach($technologies as $tech)
                            <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                <div>
                                    <h6 class="mb-1">{{ $tech['name'] }}</h6>
                                    <small class="text-muted">{{ $tech['cohortCount'] }} Cohorts</small>
                                </div>
                                <span class="badge {{ $tech['active'] ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $tech['active'] ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications Column -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center py-2">
                    <h6 class="card-title mb-0" style="font-size: 0.8rem;">
                        <i class="fas fa-bell me-2"></i>Notifications
                    </h6>
                    <span class="badge bg-light text-dark" style="font-size: 0.7rem;">{{ $notifications->count() }} New</span>
                </div>
                <div class="card-body p-0">
                    @if($notifications->isEmpty())
                    <div class="text-center py-3">
                        <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0" style="font-size: 0.8rem;">No recent notifications.</p>
                    </div>
                    @else
                    <div class="notification-list">
                        @foreach($notifications as $notification)
                        <div class="notification-item d-flex align-items-center p-2 border-bottom hover-effect">
                            <div class="notification-icon me-2">
                                @switch($notification['type'])
                                @case('Absence')
                                <span class="badge bg-soft-warning text-warning p-2">
                                    <i class="fas fa-calendar-times"></i>
                                </span>
                                @break
                                @case('Assignment')
                                <span class="badge bg-soft-primary text-primary p-2">
                                    <i class="fas fa-tasks"></i>
                                </span>
                                @break
                                @case('Technology')
                                <span class="badge bg-soft-info text-info p-2">
                                    <i class="fas fa-laptop-code"></i>
                                </span>
                                @break
                                @case('Announcement')
                                <span class="badge bg-soft-dark text-dark p-2">
                                    <i class="fas fa-bullhorn"></i>
                                </span>
                                @break
                                @case('Cohort')
                                <span class="badge bg-soft-success text-success p-2">
                                    <i class="fas fa-users"></i>
                                </span>
                                @break
                                @case('Enrollment')
                                <span class="badge bg-soft-success text-success p-2">
                                    <i class="fas fa-user-plus"></i>
                                </span>
                                @break
                                @default
                                <span class="badge bg-soft-secondary text-secondary p-2">
                                    <i class="fas fa-bell"></i>
                                </span>
                                @endswitch
                            </div>
                            <div class="notification-content flex-grow-1">
                                <h6 class="mb-0" style="font-size: 0.8rem;">{{ $notification['title'] }}</h6>
                                <p class="text-muted mb-0" style="font-size: 0.7rem;">{{ $notification['type'] }}</p>
                            </div>
                            <div class="notification-time text-muted" style="font-size: 0.6rem;">
                                {{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


</main>


<style>

.col-lg-12 {
    width: 50% !important;
}
</style>

@include('admin.partials.footer')



<!-- Gender Chart Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    const cohortProgress = {!! json_encode($cohortProgress) !!};

    const ctxCohortProgress = document.getElementById('cohortProgressChart').getContext('2d');
    const cohortProgressChart = new Chart(ctxCohortProgress, {
        type: 'line',
        data: {
            labels: cohortProgress.labels,  // Time labels or cohort names
            datasets: cohortProgress.datasets,  // Dataset array with progress data
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true,
                    max: 100
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.dataset.label + ': ' + tooltipItem.raw + '%';  // Display progress as percentage
                        }
                    }
                }
            }
        }
    });
</script>
<script>
   const genderDistribution = {!! json_encode($genderDistribution) !!};

const ctx = document.getElementById('genderChart').getContext('2d');
const genderChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: genderDistribution.labels,
        datasets: [{
            label: 'Gender Distribution',
            data: genderDistribution.datasets[0].data,
            backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e'],
            borderColor: ['#ffffff', '#ffffff', '#ffffff'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ' + tooltipItem.raw + ' students';
                    }
                }
            }
        }
    }
});

</script>
