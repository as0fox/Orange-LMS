<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orange LMS</title>

    <!-- Boosted Orange Framework -->
    <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/css/boosted.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  

</head>

<body>
    <!-- Mobile Header -->
    <div class="mobile-header">
        <div class="d-flex align-items-center">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyODMuNDYgMjgzLjQ2Ij48cGF0aCBkPSJNMCAwaDI4My40NnYyODMuNDZIMHoiIGZpbGw9IiNmZjc5MDAiLz48cGF0aCBkPSJNNDAuNTEgMjAyLjQ3aDIwMi40N3Y0MC41SDQwLjUxeiIgZmlsbD0iI2ZmZiIvPjwvc3ZnPg=="
                width="50" class="me-2">
            <span class="h4 mb-0">Orange LMS</span>
        </div>
        <button class="btn btn-link" onclick="toggleSidebar()">
            <i class="fas fa-bars text-white"></i>
        </button>
    </div>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyODMuNDYgMjgzLjQ2Ij48cGF0aCBkPSJNMCAwaDI4My40NnYyODMuNDZIMHoiIGZpbGw9IiNmZjc5MDAiLz48cGF0aCBkPSJNNDAuNTEgMjAyLjQ3aDIwMi40N3Y0MC41SDQwLjUxeiIgZmlsbD0iI2ZmZiIvPjwvc3ZnPg=="
                width="50" class="me-2">
            <span class="h4 mb-0">Orange LMS</span>
        </div>

        <nav class="mt-4 px-3">

            <ul class="nav flex-column">

                <li class="nav-item"><a class="nav-link <?= $dashboard_active ?? '' ?>" href="/trainee/dashboard"><i
                            class="fas fa-home"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link <?= $cohort_active ?? '' ?>" href="/trainee/cohort"><i
                            class="fas fa-book"></i> My Cohort</a></li>
                <li class="nav-item"><a class="nav-link <?= $technology_active ?? '' ?>" href="/trainee/technology"><i class="fas fa-laptop-code"></i> Technologies</a>
                </li>
                <li class="nav-item"><a class="nav-link <?=  $assignments_active ?? '' ?>" href="/trainee/assignment"><i class="fas fa-tasks"></i> Assignments</a></li>
                <li class="nav-item"><a class="nav-link <?=  $announcements_active ?? '' ?>" href="/trainee/announcements"><i class="fas fa-bullhorn"></i> Announcements</a></li>
                <li class="nav-item"><a class="btn-outline-Blue" href="https://simplonline.co/login"><i
                            class="fa-solid fa-o"></i>Simplonline</a></li>
            </ul>
        </nav>


        <form method="POST" action="{{ route('logout') }}" class="px-3 mt-auto mb-3">
            @csrf
            <button class="btn btn-outline-danger w-100"><i class="fas fa-sign-out-alt me-2"></i>Log Out</button>
        </form>
    </aside>


    <!-- Main Content -->
    <main class="main-content">
        <!-- Updated Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white px-1 py-1 shadow-sm">
            <div class="container-fluid">
                <ol class="breadcrumb mb-10">
                    <li class="breadcrumb-item">Student</li>
                    <li class="breadcrumb-item active"><?= $page ??'Dashboard'?></li>
                </ol>
                <br>
                <div class="d-flex align-items-center ms-auto">

                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false" style="color:rgb(0, 0, 0);">
                                {{ $user->name }} &nbsp; <img
                                    src="{{ $user->image ? asset('assets/' . $user->image) : asset('storage/images/users/avatar.png') }}"
                                    width="30" height="30" class="rounded-circle" alt="User Image">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item text-black" href="{{ route('studentProfile.index') }}">
                                        <img src="{{ $user->image ? asset('assets/' . $user->image) : asset('storage/images/users/avatar.png') }}"
                                            width="30" height="30" class="rounded-circle" alt="User Image">&nbsp; Profile</a>
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">
                                            <i class="fas fa-sign-out-alt me-2"></i>Log Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>