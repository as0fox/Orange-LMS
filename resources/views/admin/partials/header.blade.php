<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orange Admin</title>

    <!-- Boosted Orange Framework -->
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/css/orange-helvetica.min.css" rel="stylesheet"
        integrity="sha384-A0Qk1uKfS1i83/YuU13i2nx5pk79PkIfNFOVzTcjCMPGKIDj9Lqx9lJmV7cdBVQZ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/css/boosted.min.css" rel="stylesheet"
        integrity="sha384-laZ3JUZ5Ln2YqhfBvadDpNyBo7w5qmWaRnnXuRwNhJeTEFuSdGbzl4ZGHAEnTozR" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
    :root {
        --orange-primary: #ff7900;
        --orange-dark: #cc6100;
        --orange-light: #ffe5d2;
    }

    .bg-orange-primary {
        background-color: var(--orange-primary) !important;
    }

    .bg-orange-light {
        background-color: var(--orange-light) !important;
    }

    .text-orange-primary {
        color: var(--orange-primary) !important;
    }

    .border-orange {
        border-color: var(--orange-primary) !important;
    }

    .active {
        background-color: var(--orange-light);
        color: var(--orange-primary);
    }

    .dropdown .nav-link {
        color: var(--orange-primary);
    }
    .bg-orange {
    background-color: #ff7600;
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
        overflow-y: auto !important;
        /* Enable vertical scrolling */
        padding-bottom: 20px;
        /* Add some spacing at the bottom */
        scrollbar-width: thin;
        scrollbar-color: var(--orange-primary) #f8f9fa;
        /* Thumb and track colors */
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

    .nav-link:hover,
    .nav-link.active {
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
    .profile-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 30px 20px;
    animation: fadeIn 0.5s ease;
}

.profile-header {
    display: flex;
    gap: 40px;
    margin-bottom: 40px;
    animation: slideUp 0.5s ease;
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.profile-image-wrapper {
    flex: 0 0 200px;
}

.profile-image-container {
    width: 200px;
    height: 200px;
    position: relative;
    cursor: pointer;
}

.profile-image {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    transition: all 0.3s ease;
    border: 5px solid #fff;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.profile-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.profile-image-overlay i {
    color: white;
    font-size: 24px;
}

.profile-image-container:hover .profile-image-overlay {
    opacity: 1;
}

.profile-image-container:hover .profile-image {
    transform: scale(1.02);
}

.profile-info {
    flex: 1;
}

.profile-name-section {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.profile-name-section h1 {
    font-size: 32px;
    margin: 0;
    font-weight: 600;
    color: #333;
}

.edit-profile-btn {
    padding: 8px 20px;
    border-radius: 8px;
    border: none;
    background: #ff7900;
    color: white;
    font-weight: 500;
    transition: all 0.3s ease;
}

.edit-profile-btn:hover {
    background: #e66d00;
    transform: translateY(-2px);
}

.settings-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ff7600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.settings-icon:hover {
    background: #e9ecef;
    transform: rotate(90deg);
}

.profile-stats {
    display: flex;
    gap: 30px;
    margin-bottom: 25px;
}

.stat-item {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.stat-label {
    font-size: 14px;
    color: #666;
}

.stat-text {
    font-weight: 600;
    color: #333;
}

.profile-details {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #555;
}

.detail-item i {
    color: #ff7900;
    width: 20px;
}

.info-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 30px;
    animation: slideUp 0.5s ease 0.2s both;
}

.info-card {
    border-radius: 15px;
    border: none;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.card-title {
    
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-title i {
    color: #ff7900;
}

.info-item {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    color: #666;
}

.info-value {
    font-weight: 500;
    color: #333;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

/* Responsive Design */
@media (max-width: 768px) {
    .profile-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .profile-image-wrapper {
        flex: 0 0 auto;
    }

    .profile-name-section {
        justify-content: center;
    }

    .profile-stats {
        justify-content: center;
    }

    .profile-details {
        align-items: center;
    }
}

/* Modern Badge Styles */
.status-badge {
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.status-badge-pending {
    background: linear-gradient(45deg, #ffd700, #ffa500);
    color: #000;
}

.status-badge-approved {
    background: linear-gradient(45deg, #00b09b, #96c93d);
    color: #fff;
}

.status-badge-rejected {
    background: linear-gradient(45deg, #ff416c, #ff4b2b);
    color: #fff;
}

.absence-type-badge {
    padding: 5px 10px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 0.85rem;
    background: #f8f9fa;
    border: 2px solid;
}

.absence-type-excused {
    border-color: #0ea5e9;
    color: #0ea5e9;
}

.absence-type-unexcused {
    border-color: #dc2626;
    color: #dc2626;
}

.absence-type-delay {
    border-color: #f59e0b;
    color: #f59e0b;
}

/* Export Button Styles */
.export-btn {
    padding: 8px 16px;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    border-radius: 6px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-right: 10px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.export-btn:hover {

    box-shadow: 0 4px 6px rgba(0,0,0,0.15);
}

.export-btn-copy {
    background: #ff7900;
    color: black;
    font-weight: bold;
}

.export-btn-excel {
    background: #ff7900;
    color: black;
    font-weight: bold;
}

.export-btn-pdf {
    background: #ff7900;
    color: black;
    font-weight: bold;
}

.export-btn-print {
    background: #ff7900;
    color: black;
    font-weight: bold;
}

.export-btn i {
    font-size: 1rem;
}

/* Container for export buttons */
.export-buttons-wrapper {
  
    padding: 1rem;
    background: black;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
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
                    <path d="M0 0h283.46v283.46H0z" fill="#ff7900" />
                    <path d="M40.51 202.47h202.47v40.5H40.51z" fill="#fff" />
                </svg>
                <span class="h4 mb-0 text-orange-primary">Admin panel</span>
            </div>
        </div>
@if($user->type == "admin")
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
             
                <li class="nav-item">
                    <a class="nav-link {{ $trainees_active ?? '' }}" href="{{route('admin.trainees')}}">
                        <i class="fas fa-user-graduate me-2"></i> Trainees
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $jobCoaches_active?? '' ?>" href="{{route('jobCoaches.index')}}">
                        <i class="fas fa-user-friends me-2"></i> Job Coaches
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $technologies_active ?? '' ?>" href="{{route('technologies.index')}}">
                        <i class="fas fa-laptop-code me-2"></i> Technologies
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $technologiesToCohort_active ?? '' ?>"
                        href="{{route('techno_to_cohort.index')}}">
                        <i class="fas fa-laptop-code me-2"></i> Technologies Assignment
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $assignments_active ?? '' ?>" href="{{route('assignments.index')}}">
                        <i class="fas fa-tasks me-2"></i> Assignments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $submitted_assignments_active ?? '' ?>" href="{{route('admin.submitted-assignments.index')}}">
                        <i class="fas fa-tasks me-2"></i> Assignments Submitted
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $absences_rules_active ?? '' ?>"
                        href="{{route('admin.absence_rules.index')}}">
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
        @endif


        @if($user->type == "trainer")
        <!-- Navigation -->
        <nav class="mt-2">
            <ul class="nav flex-column">
            <li class="nav-item">
                    <a class="nav-link <?= $dashboard_active ?? '' ?>" href="{{route('admin.dashboard')}}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $trainees_active ?? '' }}" href="{{route('admin.trainees')}}">
                        <i class="fas fa-user-graduate me-2"></i> Trainees
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $technologies_active ?? '' ?>" href="{{route('technologies.index')}}">
                        <i class="fas fa-laptop-code me-2"></i> Technologies
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $technologiesToCohort_active ?? '' ?>"
                        href="{{route('techno_to_cohort.index')}}">
                        <i class="fas fa-laptop-code me-2"></i> Technologies Assignment
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $assignments_active ?? '' ?>" href="{{route('assignments.index')}}">
                        <i class="fas fa-tasks me-2"></i> Assignments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $submitted_assignments_active ?? '' ?>" href="{{route('admin.submitted-assignments.index')}}">
                        <i class="fas fa-tasks me-2"></i> Assignments Submitted
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
        @endif
        @if($user->type == "manager")
        <!-- Navigation -->
        <nav class="mt-2">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= $dashboard_active ?? '' ?>" href="{{route('admin.dashboard')}}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $cohorts_active ?? '' ?>" href="{{route('admin.cohorts')}}">
                        <i class="fas fa-regular fa-user-graduate me-2"></i> Cohort
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $trainers_active ?? '' ?>" href="{{route('admin.trainers')}}">
                        <i class="fas fa-chalkboard-teacher me-2"></i> Trainers
                    </a>
                </li>
             
                <li class="nav-item">
                    <a class="nav-link {{ $trainees_active ?? '' }}" href="{{route('admin.trainees')}}">
                        <i class="fas fa-user-graduate me-2"></i> Trainees
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $jobCoaches_active?? '' ?>" href="{{route('jobCoaches.index')}}">
                        <i class="fas fa-user-friends me-2"></i> Job Coaches
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $technologies_active ?? '' ?>" href="{{route('technologies.index')}}">
                        <i class="fas fa-laptop-code me-2"></i> Technologies
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $technologiesToCohort_active ?? '' ?>"
                        href="{{route('techno_to_cohort.index')}}">
                        <i class="fas fa-laptop-code me-2"></i> Technologies Assignment
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $assignments_active ?? '' ?>" href="{{route('assignments.index')}}">
                        <i class="fas fa-tasks me-2"></i> Assignments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $submitted_assignments_active ?? '' ?>" href="{{route('admin.submitted-assignments.index')}}">
                        <i class="fas fa-tasks me-2"></i> Assignments Submitted
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $absences_rules_active ?? '' ?>"
                        href="{{route('admin.absence_rules.index')}}">
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
        @endif
        @if($user->type == "job-coach")
        <!-- Navigation -->
        <nav class="mt-2">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= $dashboard_active ?? '' ?>" href="{{route('admin.dashboard')}}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $absences_rules_active ?? '' ?>"
                        href="{{route('admin.absence_rules.index')}}">
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
        @endif
        <ul class="nav flex-column pb-3 pt-3">
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="nav-link text-danger" type="submit">
                        <i class="fas fa-sign-out-alt me-2"></i> {{ __('Log Out') }}
                    </button>
                </form>
            </li>
        </ul>
    </aside>


    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 py-3 shadow-sm ">
            <div class="container-fluid">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item active">{{ $page ?? 'Dashboard' }}</li>
                </ol>
                <div class="d-flex align-items-center ms-auto">
                    <div class="nav-item dropdown ">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                            {{ $user->name }}&nbsp;
                            @if($user->image)
                            <img src="{{ asset('assets/' . $user->image) }}" width="30" height="30"
                                class="rounded-circle" alt="" />
                            @else
                            <i class="fas fa-user-circle fa-lg"></i>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item text-black" href="{{ route('profile.index') }}"> @if($user->image)
                                    <img src="{{ asset('assets/' . $user->image) }}" width="20" height="20"
                                        class="rounded-circle" alt="" />
                                    @else
                                    <i class="fas fa-user-circle fa-lg"></i>
                                    @endif
                                    Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">
                                        <i class="fas fa-sign-out-alt me-2"></i>Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>