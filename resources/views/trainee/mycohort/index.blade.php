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
    --text-black: black;
    --light-blue: #3498db;
    --deep-blue: #2980b9;
}

body {
    background-color: var(--light-orange);
    font-family: 'Inter', sans-serif;
    color: var(--text-white);
}

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
.sidebar {
    background-color: black;
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
    background-color: var(--text-white);
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

.breadcrumb .active {
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

/* Timeline Styles */
.timeline-container {
    position: relative;
    margin: 0 auto;
    max-width: 800px;
    padding: 20px;
}

.timeline {
    position: relative;
    margin: 0;
    padding: 0;
    list-style-type: none;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.timeline-item {
    position: relative;
    margin: 20px 0;
    width: 100%;
    display: flex;
 
    justify-content: flex-start;
    align-items: center;
}

.timeline-item:before {
    content: '';
    position: absolute;
    left: 20px;
    top: 0;
    width: 2px;
    height: 100%;
    background-color: var(--vibrant-orange);
    z-index: 1;
}

.timeline-item:last-child:before {
    height: 0; /* Remove the line after the last item */
}

.timeline-content {
    position: relative;
    background-color: var(--soft-orange);
    color: var(--text-black);
    border-radius: 8px;
    padding: 15px 20px;
    box-shadow: 2px 2px 10px black;
    border-radius: 10px;
    z-index: 2;
    margin-left: 50px;
    width: calc(100% - 60px);
}

.timeline-content h6 {
    margin: 0;
    font-size: 18px;
    font-weight: bold;
    color: var(--deep-orange);
}

.timeline-content p {
    margin: 5px 0 0;
    font-size: 14px;
    color: var(--text-black);
}

.timeline-item:after {
    content: '';
    position: absolute;
    left: 14px;
    top: 10px;
    width: 15px;
    height: 15px;
    background-color: var(--vibrant-orange);
    border: 3px solid var(--soft-orange);
    border-radius: 50%;
    z-index: 3;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .timeline-content {
        width: calc(100% - 40px);
        margin-left: 40px;
    }

    .timeline-item:before {
        left: 10px;
    }

    .timeline-item:after {
        left: 4px;
    }
}
.training-road-container {
            position: relative;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 50px 20px;
            background-color: #f4f4f4;
            overflow: hidden;
        }

        .road {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 10px;
            background: linear-gradient(to right, #000, #fff);
            transform: translateY(-50%);
            z-index: 1;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .training-milestones {
            position: relative;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            z-index: 2;
        }

        .milestone {
            width: calc(14.28% - 20px);
            text-align: center;
            position: relative;
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
        }

        .milestone.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .milestone-marker {
            width: 60px;
            height: 60px;
            background-color: #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: white;
            font-size: 24px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            position: relative;
            z-index: 3;
            border: 5px solid #fff;
            transition: transform 0.3s ease;
        }

        .milestone-marker:hover {
            transform: scale(1.1);
        }

        .milestone-content {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-top: 15px;
            border-left: 5px solid #000;
            transition: all 0.3s ease;
        }

        .milestone-content:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        .milestone-content h6 {
            color: #000;
            margin-bottom: 10px;
        }

        .milestone-content p {
            color: #333;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .milestone {
                width: 100%;
                margin-bottom: 30px;
            }

            .road {
                height: 5px;
            }
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
                <li class="nav-item"><a class="nav-link " href="/trainee/dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link active" href="/trainee/cohort"><i class="fas fa-book"></i> My Cohort</a></li>
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

    <main class="main-content">
        <!-- Updated Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-1 py-1">
        <div class="container-fluid">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active">My Cohort</li>
            </ol>
            <div class="d-flex align-items-center ms-auto">
                <div class="position-relative me-3">
                    <input type="search" class="form-control" placeholder="Search...">
                    <i class="fas fa-search position-absolute top-50 end-0 translate-middle-y me-2"></i>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle fa-lg"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user me-2"></i>Profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout.trainee') }}">
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


        <div class="container mt-4">
            <!-- Cohort Info Section -->
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-users me-2"></i>Cohort Name</h5>
                            <p class="card-text">Orange Web Development Cohort</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-calendar-alt me-2"></i>Start Date</h5>
                            <p class="card-text">January 1, 2024</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-calendar-check me-2"></i>End Date</h5>
                            <p class="card-text">June 1, 2024</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Training Plan Section -->
            <h2 class="section-title text-center mb-4"><i class="fas fa-calendar-alt me-2"></i>Training Plan</h2>
            <div class="training-road-container">
        <div class="road"></div>
        <div class="training-milestones">
            <div class="milestone" style="color: #000000;">
                <div class="milestone-marker">1</div>
                <div class="milestone-content" >
                    <h6>HTML</h6>
                    <p>Master web structure and content creation fundamentals</p>
                </div>
            </div>
            <div class="milestone">
                <div class="milestone-marker">2</div>
                <div class="milestone-content">
                    <h6>CSS</h6>
                    <p>Design responsive and visually appealing layouts</p>
                </div>
            </div>
            <div class="milestone">
                <div class="milestone-marker">3</div>
                <div class="milestone-content">
                    <h6>JavaScript</h6>
                    <p>Create dynamic and interactive web experiences</p>
                </div>
            </div>
            <div class="milestone">
                <div class="milestone-marker">4</div>
                <div class="milestone-content">
                    <h6>Bootstrap</h6>
                    <p>Leverage pre-built components for rapid development</p>
                </div>
            </div>
            <div class="milestone">
                <div class="milestone-marker">5</div>
                <div class="milestone-content">
                    <h6>PHP</h6>
                    <p>Build server-side functionality and backend logic</p>
                </div>
            </div>
            <div class="milestone">
                <div class="milestone-marker">6</div>
                <div class="milestone-content">
                    <h6>Laravel</h6>
                    <p>Develop robust web applications with modern PHP framework</p>
                </div>
            </div>
            <div class="milestone">
                <div class="milestone-marker">7</div>
                <div class="milestone-content">
                    <h6>React</h6>
                    <p>Create powerful and efficient front-end applications</p>
                </div>
            </div>
        </div>
    </div>
            <br> <br>
            <!-- Trainers Section -->
            <h2 class="section-title text-center mb-4"><i class="fas fa-users-cog me-2"></i>Team</h2>
            <div class="row g-4">
            <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm h-100">
                        <img src="{{asset('assets/managers/KVhylTmz_NhNn_1024.webp')}}" class="card-img-top" alt="Manager">
                        <div class="card-body">
                            <h5 class="card-title">Salamah Yasin</h5>
                            <p class="card-text">Manager</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    
                    <div class="card text-center border-0 shadow-sm h-100">
                        <img src="{{asset('assets/trainer/il_300x300.5777575448_eibc.webp')}}" class="card-img-top" alt="Trainer">
                        <div class="card-body">
                            <h5 class="card-title">Ala'a</h5>
                            <p class="card-text">Trainer</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center border-0 shadow-sm h-100">
                        <img src="{{asset('assets/job_coaches/2d40975422bb9c04a07f69bfe2aaf8a7.jpg')}}" class="card-img-top" alt="Job Coach">
                        <div class="card-body">
                            <h5 class="card-title">Hadel alshahuan</h5>
                            <p class="card-text">Job Coach</p>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const mobileHeader = document.querySelector('.mobile-header');
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnMobileHeader = mobileHeader.contains(event.target);

            if (!isClickInsideSidebar && !isClickOnMobileHeader && window.innerWidth <= 992) {
                sidebar.classList.remove('active');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const milestones = document.querySelectorAll('.milestone');
            
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            milestones.forEach(milestone => {
                observer.observe(milestone);
            });
        });
    </script>

</body>
</html>
