<?php $dashboard_active = "active" ;
$page="Dashboard "; ?>

@include('trainee.partials.header')




    <div class="stat-section " >
        <div class="stat-card border">
            <i class="fas fa-calendar-alt"></i>
            <h5>Start Date</h5>
            <p>{{$cohort->start_date}}</p>
        </div>
        <div class="stat-card border">
            <i class="fas fa-graduation-cap"></i>
            <h5>Program</h5>
            <p>Web Development</p>
        </div>

        <div class="stat-card border">
            <i class="fas fa-laptop-code"></i>
            <h5>Technologies</h5>
            <p>{{ count($technologies) }} Modules</p>
        </div>

    </div>

    <div class="row">
        @foreach ($announcements as $announcement)
        <div class="col-md-6 col-lg-4">
            <div class="card border">
                <img src="{{asset('assets\announcement\announcement.jpg')}}" class="card-img-top" alt="HTML">
                <div class="card-body">
                    <h5 class="card-title">{{$announcement->title}}</h5>
                    <p class="card-text">{{$announcement->content}}</p>
                </div>
            </div>
        </div>
        @endforeach
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