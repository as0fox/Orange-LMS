<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orange Admin</title>

    <!-- Boosted Orange Framework -->
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/css/boosted.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --orange-primary: #ff7900;
            --orange-dark: #cc6100;
            --orange-light: #ffe5d2;
        }

        .bg-orange-primary { background-color: var(--orange-primary) !important; }
        .bg-orange-light { background-color: var(--orange-light) !important; }
        .text-orange-primary { color: var(--orange-primary) !important; }
        .border-orange { border-color: var(--orange-primary) !important; }

        .active {
            background-color: var(--orange-light);
            color: var(--orange-primary);
        }
.dropdown .nav-link{
    color:var(--orange-primary);
}
        .sidebar {
            width: 250px;
            background: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
        }

        .sidebar nav {
            flex: 1;
            overflow-y: auto !important; /* Enable vertical scrolling */
            padding-bottom: 20px; /* Add some spacing at the bottom */
            scrollbar-width: thin;
            scrollbar-color: var(--orange-primary) #f8f9fa; /* Thumb and track colors */
        }

        /* For Webkit browsers (Chrome, Safari, etc.) */
        .sidebar nav::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar nav::-webkit-scrollbar-thumb {
            background-color: var(--orange-primary);
            border-radius: 10px;
        }

        .sidebar nav::-webkit-scrollbar-track {
            background-color: #f8f9fa;
        }

        .main-content {
            margin-left: 250px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: var(--orange-light);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--orange-primary);
        }

        .background-icon {
            position: absolute;
            right: -20px;
            bottom: -20px;
            font-size: 100px;
            opacity: 0.05;
            transform: rotate(-15deg);
        }

        .nav-link {
            border-radius: 8px;
            margin: 5px 15px;
            padding: 10px 15px;
           color: #fff;
            transition: all 0.3s;
            position: relative;
        }

        .nav-link:hover, .nav-link.active {
            background-color: var(--orange-light);
            color: var(--orange-primary);
        }

        .progress {
            height: 8px;
        }

        .card {
            position: relative;
            overflow: hidden;
        }

        .card .background-icon {
            position: absolute;
            right: -20px;
            bottom: -20px;
            font-size: 150px;
            opacity: 0.05;
            transform: rotate(-15deg);
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar bg-black">
    <div class="p-3 border-bottom">
        <div class="d-flex align-items-center">
            <!-- Orange Logo SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 283.46 283.46" class="me-2" style="width: 40px">
                <path d="M0 0h283.46v283.46H0z" fill="#ff7900"/>
                <path d="M40.51 202.47h202.47v40.5H40.51z" fill="#fff"/>
            </svg>
            <span class="h4 mb-0 text-orange-primary">Admin panel</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="mt-2">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= $dashboard_active ?? '' ?>" href="{{route('admin.dashboard')}}">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $academies_active ?? '' ?>" href="{{route('admin.academies')}}">
                    <i class="fas fa-school me-2"></i> Academies
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $cohorts_active ?? '' ?>" href="{{route('admin.cohorts')}}">
                    <i class="fas fa-regular fa-user-graduate me-2"></i> Cohort
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $managers_active ?? '' ?>" href="{{route('admin.managers')}}">
                    <i class="fas fa-user-tie me-2"></i> Managers
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $trainers_active ?? '' ?>" href="{{route('admin.trainers')}}">
                    <i class="fas fa-chalkboard-teacher me-2"></i> Trainers
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link {{ $classrooms_active ?? '' }}" href="{{route('admin.classrooms') }}">
                    <i class="fas fa-solid fa-door-open me-2"></i> Classrooms
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link {{ $trainees_active ?? '' }}" href="{{route('admin.trainees')}}">
                    <i class="fas fa-user-graduate me-2"></i> Trainees
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $job_coaches_active ?? '' ?>" href="{{route('jobCoaches.index')}}">
                    <i class="fas fa-user-friends me-2"></i> Job Coaches
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $technologies_active ?? '' ?>" href="{{route('technologies.index')}}">
                    <i class="fas fa-laptop-code me-2"></i> Technologies
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $technologiesToCohort_active ?? '' ?>" href="{{route('techno_to_cohort.index')}}">
                    <i class="fas fa-laptop-code me-2"></i> Technologies To Cohort
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $assignments_active ?? '' ?>" href="{{route('assignments.index')}}">
                    <i class="fas fa-tasks me-2"></i> Assignments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $absences_rules_active ?? '' ?>" href="{{route('admin.absence_rules.index')}}">
                    <i class="fas fa-calendar-minus me-2"></i> Absences Rules
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $absences_active ?? '' ?>" href="/admin/absences">
                    <i class="fas fa-calendar-minus me-2"></i> Absences
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $announcements_active ?? '' ?>" href="/admin/announcements">
                    <i class="fas fa-bullhorn me-2"></i> Announcements
                </a>
            </li>
        </ul>
    </nav>
    <ul class="nav flex-column pb-3 pt-3">
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="nav-link text-danger" type="submit">
                    <i class="fas fa-sign-out-alt me-2"></i>   {{ __('Log Out') }}
                </button>
            </form>
        </li>
    </ul>
</aside>
