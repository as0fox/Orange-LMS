
<?php
$Ongoing = 0; 
$DidntStart = 0;

foreach ($technologies as $technology) {
    if ($technology->start_date <= now()) {
        $Ongoing++;
    } else {
        $DidntStart++;
    }
}

$technology_active="active";
$page = 'technologies';

?>




@include('trainee.partials.header')

<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title"><i class="fas fa-laptop-code me-2"></i>Technologies</h2>
        <div class="d-flex gap-3">
            <span class="status-badge status-completed">{{$Ongoing}} Ongoing</span>
            <span class="status-badge status-in-progress">{{$DidntStart}} Upcoming</span>
        </div>
    </div>

    <!-- Technology Grid -->
    <div class="tech-grid">
        <!-- HTML & CSS Card -->

        @foreach ($technologies as $technology)
        <div class="tech-card">
            <div class="tech-icon" >
                <i class="fab fa-{{ strtolower($technology->name)}}" style="@if ($technology->start_date <= now()) color: lightgreen; @endif"></i>
            </div>
            <div class="tech-content">
                <h5 class="text-black">{{ $technology->name }}</h5>:]<br>
                <p class="text-muted">{{ $technology->description }}</p>
                <div class="tech-progress">
                    <div class="progress-bar" style="width: 100% ; @if ($technology->start_date <= now()) background-color: lightgreen; @endif"></div>

                </div>
                <div class="tech-stats">
                    @if ($technology->start_date <= now())
                     <span class="status-badge status-completed">Ongoing</span>
                        @else
                        <span class="status-badge status-in-progress">Upcoming</span>
                        @endif

                </div>
            </div>
        </div>
        @endforeach

    </div>

    <!-- Learning Resources Section -->
    <div class="resource-section">
        <h3 class="mb-4"><i class="fas fa-book-reader me-2"></i>Learning Resources</h3>

        <div class="resource-card">
            <i class="fas fa-video fa-2x text-primary"></i>
            <div class="flex-grow-1">
                <h6 class="mb-1">HTML & CSS Fundamentals</h6>
                <p class="text-muted mb-0">Complete video course with practical examples</p>
            </div>
            <span class="status-badge status-completed">Completed</span>
        </div>

        <div class="resource-card">
            <i class="fas fa-laptop-code fa-2x text-warning"></i>
            <div class="flex-grow-1">
                <h6 class="mb-1">JavaScript Interactive Exercises</h6>
                <p class="text-muted mb-0">Practice with real-world coding challenges</p>
            </div>
            <span class="status-badge status-in-progress">In Progress</span>
        </div>

        <div class="resource-card">
            <i class="fas fa-server fa-2x text-info"></i>
            <div class="flex-grow-1">
                <h6 class="mb-1">PHP & MySQL Development</h6>
                <p class="text-muted mb-0">Backend development fundamentals</p>
            </div>
            <span class="status-badge status-upcoming">Upcoming</span>
        </div>
    </div>
</div>
</main>

<script>
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('active');
}

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


@include('trainee.partials.footer')