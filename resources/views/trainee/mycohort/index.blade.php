<?php $cohort_active = "active" ;
$page="Cohort ";
?>
@include('trainee.partials.header')

<!-- Cohort Info Section -->
<div class="row g-4 mb-5">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-users me-2"></i>{{$cohort->name}}</h5>
                <p class="card-text">Orange Web Development Cohort</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-calendar-alt me-2"></i>Start Date</h5>
                <p class="card-text">{{$cohort->start_date}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-calendar-check me-2"></i>End Date</h5>
                <p class="card-text">{{$cohort->end_date}}</p>
            </div>
        </div>
    </div>
</div>

<!-- Training Plan Section -->
<h2 class="section-title text-center mb-4"><i class="fas fa-calendar-alt me-2"></i>Training Plan</h2>
<div class="training-road-container">
    <div class="road"></div>
    <div class="training-milestones">

        @foreach($technologies as $technology)
        <div class="milestone">
            <div class="{{ $technology->start_date <= now() ? 'milestone-marker_start' : 'milestone-marker' }}">
                {{ $loop->iteration }}
            </div>
            <div class="{{ $technology->start_date <= now() ? 'milestone-content_start' : 'milestone-content' }}">
                <h6>{{ $technology->name }}</h6>
                <p>{{ $technology->description }}</p>
            </div>
        </div>
        @endforeach

    </div>
</div>
<br> <br>
<!-- Trainers Section -->
 
<h2 class="section-title text-center mb-4"><i class="fas fa-users-cog me-2"></i>Team</h2>
<div class="row g-4">
    <div class="col-md-4">
        <div class="card text-center border border-2 border-dark shadow-sm h-100">
            <div class="px-3 pt-3">
                <img src="{{asset('assets/'. $manager->image )}}" class="card-img-top rounded-circle border border-2 border-dark" alt="Manager" style="width: 200px; height: 200px; object-fit: cover;">
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$manager->name}}</h5>
                <p class="card-text">Manager</p>
            </div>
        </div>
    </div>
    @foreach($trainers as $trainer)
    <div class="col-md-4">
        <div class="card text-center border border-2 border-dark shadow-sm h-100">
            <div class="px-3 pt-3">
                <img src="{{asset('assets/'. $trainer->image )}}" class="card-img-top rounded-circle border border-2 border-dark" alt="Trainer" style="width: 200px; height: 200px; object-fit: cover;">
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$trainer->name}}</h5>
                <p class="card-text">Trainer</p>
            </div>
        </div>
    </div>
    @endforeach
    @foreach($jobcoachs as $jobcoach)
    <div class="col-md-4 ">
        <div class="card text-center border border-2 border-dark shadow-sm h-100 ">
            <div class="px-3 pt-3">
                <img src="{{asset('assets/'. $jobcoach->image)}}" class="card-img-top rounded-circle border border-2 border-dark" alt="Job Coach" style="width: 200px; height: 200px; object-fit: cover;">
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$jobcoach->name}}</h5>
                <p class="card-text">Job Coach</p>
            </div>
        </div>
    </div>
    @endforeach
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