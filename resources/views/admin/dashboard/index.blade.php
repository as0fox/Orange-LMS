<?php $dashboard_active = 'active' ?>

@include('admin.partials.header')

<!-- Main Content -->
<main class="main-content">
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="d-flex align-items-center ms-auto">
                <div class="position-relative me-3">
                    <input type="search" class="form-control" placeholder="Search...">
                    <i class="fas fa-search position-absolute top-50 end-0 translate-middle-y me-2"></i>
                </div>
                <div class="dropdown">
                    <a href="#" class="nav-link" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="nav-link text-black" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="nav-link text-danger" type="submit">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="p-4">
        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="stat-card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Academies</h6>
                            <h3 class="mb-0">{{ $totalAcademies }}</h3>
                            <small class="text-success">Active: {{ $activeAcademies }}</small>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-school fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stat-card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Cohorts</h6>
                            <h3 class="mb-0">{{ $totalCohorts }}</h3>
                            <small class="text-success">Active: {{ $activeCohorts }}</small>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stat-card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Assignments</h6>
                            <h3 class="mb-0">{{ $totalAssignments }}</h3>
                            <small class="text-success">Pending: {{ $pendingAssignments }}</small>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-tasks fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stat-card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Absence Requests</h6>
                            <h3 class="mb-0">{{ $totalAbsences }}</h3>
                            <small class="text-warning">Pending: {{ $pendingAbsences }}</small>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-calendar-times fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stat-card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Students</h6>
                            <h3 class="mb-0">{{ $totalStudents }}</h3>
                            <small class="text-success">Graduated: {{ $graduatedStudents }}</small>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="stat-card p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Completion Rate</h6>
                            <h3 class="mb-0">{{ $averageCompletionRate }}%</h3>
                            <small class="text-primary">New Enrollments: {{ $newEnrollmentsThisMonth }}</small>
                        </div>
                        <div class="stat-icon">
                            <i class="fas fa-chart-line fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Sections -->
        <div class="row g-4 mt-2">
            <!-- Upcoming Assignments -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-black">
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
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-black">
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

            <!-- Cohort Performance -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-black">
                        <h5 class="card-title mb-0">Cohort Performance</h5>
                    </div>
                    <div class="card-body">
                        @foreach($cohortPerformance as $cohort)
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                            <div>
                                <h6 class="mb-1">{{ $cohort['name'] }}</h6>
                                <small class="text-muted">Start: {{ $cohort['startDate'] }}</small>
                            </div>
                            <span class="badge {{ $cohort['averageScore'] >= 80 ? 'bg-success' : 'bg-warning' }}">
                                {{ $cohort['averageScore'] }}%
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.partials.footer')
