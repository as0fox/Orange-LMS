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

    <style>
        :root {
          --light-orange: #000000;
    --soft-orange: #fff;
    --vibrant-orange: #ff7900;
    --deep-orange: #cc6100;
    --text-white: #fff;
    --text-black : black;
    --light-blue: #3498db;
    --deep-blue: #2980b9;
        }

        body {
            background-color: var(--light-orange);
            font-family: 'Inter', sans-serif;
            color: var(--text-white);
        }

        /* Previous existing styles remain the same */

        .btn-outline-Blue {
            display: block;
            width: 100%;
            color: var(--deep-blue);
            border: 2px solid var(--light-blue);
            background-color: transparent;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            margin: 10px 0;
        }

        .btn-outline-Blue:hover {
            background-color: var(--light-blue);
            color: white;
            text-decoration: none;
        }

        .btn-outline-Blue i {
            margin-right: 10px;
        }

        .sidebar {
            width: 250px;
            background-color: white;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            border-right: 3px solid var(--soft-orange);
            box-shadow: 4px 0 6px rgba(255,135,0,0.1);
            transition: all 0.3s ease;
            z-index: 1050;
        }

        .sidebar-logo {
            background-color: var(--light-orange);
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sidebar{
            background-color:black;
        }

        .nav-link {
            color: var(--text-white);
            transition: all 0.3s ease;
            border-radius: 10px;
            margin: 5px 0;
            display: flex;
            align-items: center;
        }

        .nav-link:hover, .nav-link.active {
            background-color: var(--soft-orange);
            color: var(--vibrant-orange);
        }

        .nav-link i {
            margin-right: 10px;
            color: var(--vibrant-orange);
        }

        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            background-color: white;
            min-height: 100vh;
            padding: 30px;
            transition: all 0.3s ease;
        }

        .mobile-header {
            display: none;
        }

       

        .stat-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: var(  --text-white);
            color: var(--text-black);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(255,135,0,0.1);
            width: 30%;
        }

        .stat-card i {
            color: var(--vibrant-orange);
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .hero {
            background-color: var(--light-orange);
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
        }

        .hero h1 {
            color: var(--vibrant-orange);
            font-weight: 700;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(255,135,0,0.15);
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(255,135,0,0.2);
        }

        .card-body {
            background-color: var(--light-orange);
        }
        .breadcrumb .active{
             background-color: #ffceaa;

        }

         /* Responsive Adjustments */
         @media (max-width: 992px) {
    
            .sidebar {
                left: -250px;
                width: 250px;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 15px;
            }

            .mobile-header {
                display: flex;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                background-color: var(--text-black);
                z-index: 1100;
                padding: 10px;
                justify-content: space-between;
                align-items: center;
                height: 60px;
            }

            .main-content {
                padding-top: 80px;
            }

            .sidebar.active {
                left: 0;
            }

            .stat-section {
                flex-direction: column;
            }

            .stat-card {
                width: 100%;
                margin-bottom: 15px;
            }
        }
        .navbar-nav .dropdown-menu {
            background-color: var(--soft-orange);
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .navbar-nav .dropdown-item {
            color: var(--text-black);
            transition: all 0.3s ease;
        }

        .navbar-nav .dropdown-item:hover {
            background-color: var(--vibrant-orange);
            color: var(--text-white);
        }

        .navbar-nav .dropdown-toggle::after {
            color: var(--vibrant-orange);
        }

        @media (max-width: 992px) {
            .navbar-nav .dropdown-menu {
                position: static;
                background-color: transparent;
                border: none;
                box-shadow: none;
                padding: 0;
            }

            .navbar-nav .dropdown-item {
                color: var(--text-white);
                padding: 10px 15px;
            }

            .navbar-nav .dropdown-item:hover {
                background-color: rgba(255,135,0,0.2);
            }
        }
   

     
/* 
        .main-content {
            margin: 30px auto;
            max-width: 1200px;
        } */

        .section-title {
            color: var(--vibrant-orange);
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 6px 15px rgba(255, 135, 0, 0.15);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(255, 135, 0, 0.2);
        }

        .card img {
            border-radius: 15px 15px 0 0;
          
            object-fit: cover;
        }

        .timeline {
            list-style: none;
            padding: 0;
        }

        .timeline li {
            margin-bottom: 20px;
            padding: 15px;
            background-color: var(--soft-orange);
            border-left: 5px solid var(--vibrant-orange);
            border-radius: 5px;
        }

        .timeline li:last-child {
            margin-bottom: 0;
        }

        .timeline li h6 {
            margin-bottom: 5px;
            color: var(--deep-orange);
        }
    </style>
</head>
<body>
    <!-- Mobile Header -->
    <div class="mobile-header">
        <div class="d-flex align-items-center">
        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyODMuNDYgMjgzLjQ2Ij48cGF0aCBkPSJNMCAwaDI4My40NnYyODMuNDZIMHoiIGZpbGw9IiNmZjc5MDAiLz48cGF0aCBkPSJNNDAuNTEgMjAyLjQ3aDIwMi40N3Y0MC41SDQwLjUxeiIgZmlsbD0iI2ZmZiIvPjwvc3ZnPg==" width="50" class="me-2">
            <span class="h4 mb-0">Orange LMS</span>
        </div>
        <button class="btn btn-link" onclick="toggleSidebar()">
            <i class="fas fa-bars text-white"></i>
        </button>
    </div>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyODMuNDYgMjgzLjQ2Ij48cGF0aCBkPSJNMCAwaDI4My40NnYyODMuNDZIMHoiIGZpbGw9IiNmZjc5MDAiLz48cGF0aCBkPSJNNDAuNTEgMjAyLjQ3aDIwMi40N3Y0MC41SDQwLjUxeiIgZmlsbD0iI2ZmZiIvPjwvc3ZnPg==" width="50" class="me-2">
            <span class="h4 mb-0">Orange LMS</span>
        </div>

        <nav class="mt-4 px-3">
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link active" href="/trainee/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/trainee/cohort"><i class="fas fa-book"></i> My Cohort</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-laptop-code"></i> Technologies</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-tasks"></i> Assignments</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-bullhorn"></i> Announcements</a></li>
                <li class="nav-item"><a class="btn-outline-Blue" href="https://simplonline.co/login"><i class="fa-solid fa-o"></i>Simplonline</a></li>
            </ul>
</nav>

        <div class="px-3 mt-auto mb-3">
            <button class="btn btn-outline-danger w-100"><i class="fas fa-sign-out-alt me-2"></i>Log Out</button>
        </div>
    </aside>
