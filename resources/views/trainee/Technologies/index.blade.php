@include('trainee.partials.header')


    <!-- Main Content -->
    <main class="main-content">
       <!-- Updated Navbar -->
       <nav class="navbar navbar-expand-lg navbar-light bg-white px-1 py-1 shadow-sm">
        <div class="container-fluid">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active">Dashboard</li>
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

       

        <div class="stat-section">
            <div class="stat-card">
                <i class="fas fa-calendar-alt"></i>
                <h5>Start Date</h5>
                <p>January 1, 2024</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-graduation-cap"></i>
                <h5>Program</h5>
                <p>Web Development</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-laptop-code"></i>
                <h5>Technologies</h5>
                <p>8 Modules</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <img src="{{asset('assets\images\css.png')}}" class="card-img-top" alt="HTML">
                    <div class="card-body">
                        <h5 class="card-title">HTML Fundamentals</h5>
                        <p class="card-text">Master the core structure of web pages.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <img src="{{asset('assets\images\css.png')}}" class="card-img-top" alt="CSS">
                    <div class="card-body">
                        <h5 class="card-title">CSS Styling</h5>
                        <p class="card-text">Create beautiful, responsive designs.</p>
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
    </script>


@include('trainee.partials.footer')
