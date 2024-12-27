<?php $dashboard_active = "active" ;
$page="Dashboard "; 


?>

@include('trainee.partials.header')




<div class="stat-section ">
    <div class="stat-card border">
        <i class="fas fa-calendar-alt"></i>
        <h5>Start Date</h5>
        <p>{{$cohort->start_date}}</p>
    </div>
    <div class="stat-card border">
    <i class="fas fa-clock"></i>
    <h5>Absences</h5>
    <p>
        Excused: {{ $absences->excused_absences ?? 0 }} days <br>
        Unexcused: {{ $absences->unexcused_absences ?? 0 }} days <br>
        Total Delays: 
        @if( $finalDelayMinutes > 0)
            {{ $finalDelayHours }} h : {{ $remainingMinutes }} m
        @else
            No delays
        @endif
    </p>
</div>

    <div class="stat-card border">
        <i class="fas fa-laptop-code"></i>
        <h5>Technologies</h5>
        <p>{{ count($technologies) }} Modules</p>
    </div>

</div>


<div class="row g-4 justify-content-center">
    @foreach($announcements as $announcement)
    <div class="col-md-6 col-lg-4">
        <div class="instagram-card">
            <!-- Card Header -->
            <div class="card-header">
                <div class="user-info">
                    <img src="{{asset('assets/announcement/announcement.jpg')}}" class="profile-pic" alt="Profile">
                    <div>
                        <h6 class="mb-0 text-black">{{$announcement->created_by}}</h6>
                        <small class="text-muted">Admin</small>
                    </div>
                </div>
                <div class="new-icon">
            <span class="pulse"></span>
            <span class="text">NEW</span>
        </div>
            </div>

            <!-- Card Image -->
            <img src="{{asset('assets/announcement/announcement.jpg')}}" class="post-image" alt="Announcement">

            <!-- Card Actions -->
            <!-- <div class="card-actions">
                    <div class="action-buttons">
                        <i class="far fa-heart me-3"></i>
                        <i class="far fa-comment me-3"></i>
                        <i class="far fa-paper-plane"></i>
                    </div>
                </div> -->

            <!-- Card Content -->
            <div class="card-content">
                <h5 class="post-title">{{$announcement->title}}</h5>
                <p class="post-text preview-text">{{Str::limit($announcement->content, 100)}}</p>
                <div class="full-content text-black" id="content-{{$announcement->id}}">
                    {{$announcement->content}}
                </div>
                <button onclick="toggleContent({{$announcement->id}})" class="read-more-btn">
                    Read more
                </button>
                <small class="post-date">
                    {{ $announcement->date ? $announcement->date->format(' h:i A') : 'No Date' }}
                </small>
                <small class="post-date">{{$announcement->date->format('F d, Y')}}</small>
            </div>
        </div>
    </div>
    @endforeach
</div>

</main>
<style>
:root {
    --ig-border: #dbdbdb;
    --ig-text: #262626;
    --ig-secondary: #8e8e8e;
    --ig-background: #ffffff;
}

.instagram-card {
    background: var(--ig-background);
    border: 1px solid black;
    border-radius: 8px;
    margin-bottom: 24px;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    border-bottom: 1px solid black;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.profile-pic {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;

}

.more-options {
    color: var(--ig-text);
    cursor: pointer;
}

.post-image {
    width: 100%;
    aspect-ratio: 1/1;
    object-fit: cover;
}

.card-actions {
    padding: 12px;
    border-bottom: 1px solid var(--ig-border);
}

.action-buttons {
    font-size: 1.25rem;
    color: var(--ig-text);
}

.action-buttons i {
    cursor: pointer;
}

.action-buttons i:hover {
    opacity: 0.7;
}

.card-content {
    padding: 12px;
    border-top: 1px solid black;
}

.post-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--ig-text);
    margin-bottom: 8px;
}

.post-text {
    color: var(--ig-text);
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.full-content {
    display: none;
    padding: 12px;
    background: #fafafa;
    border-radius: 4px;
    margin: 8px 0;
    font-size: 0.9rem;
}

.show-content {
    display: block;
}

.read-more-btn {
    background: none;
    border: none;
    color: var(--ig-secondary);
    padding: 0;
    font-size: 0.9rem;
    cursor: pointer;
}

.read-more-btn:hover {
    color: var(--ig-text);
}

.post-date {
    display: block;
    color: var(--ig-secondary);
    margin-top: 8px;
    font-size: 0.8rem;
    text-transform: uppercase;
}

@media (max-width: 768px) {
    .instagram-card {
        margin-bottom: 16px;
    }
}
.new-icon {
    display: flex;
    align-items: center;
    gap: 6px;
}

.new-icon .pulse {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: red;
    position: relative;
}

.new-icon .pulse::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: red;
    border-radius: 50%;
    animation: pulse 1.5s infinite;
}

.new-icon .text {
    color: red;
    font-size: 12px;
    font-weight: bold;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 0.8;
    }
    70% {
        transform: scale(2);
        opacity: 0;
    }
    100% {
        transform: scale(1);
        opacity: 0;
    }
}
</style>

<script>
function toggleContent(id) {
    const content = document.getElementById(`content-${id}`);
    const button = event.target;

    if (content.classList.contains('show-content')) {
        content.classList.remove('show-content');
        button.textContent = 'Read more';
    } else {
        content.classList.add('show-content');
        button.textContent = 'Show less';
    }
}

// Like button interaction
document.addEventListener('DOMContentLoaded', function() {
    const heartButtons = document.querySelectorAll('.fa-heart');

    heartButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.toggle('far');
            this.classList.toggle('fas');
            this.classList.toggle('text-danger');
        });
    });

    // Fade in animation
    const cards = document.querySelectorAll('.instagram-card');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.5s ease';
        observer.observe(card);
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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