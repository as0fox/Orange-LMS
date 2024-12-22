<?php $announcements_active = "active";
$page = "Announcements";
?>
@include('trainee.partials.header')

<div class="container py-4">
    <h2 class="section-title text-center mb-4">
        <i class="fas fa-bullhorn me-2"></i>Announcements
    </h2>

    <div class="row g-4 justify-content-center">
        @foreach($announcements as $announcement)
        <div class="col-md-6 col-lg-4">
            <div class="instagram-card">
                <!-- Card Header -->
                <div class="card-header">
                    <div class="user-info">
                        <img src="{{asset('assets/announcement/announcement.jpg')}}" class="profile-pic" alt="Profile">
                        <div>
                            <h6 class="mb-0">{{$announcement->created_by}}</h6>
                            <small class="text-muted">Admin</small>
                        </div>
                    </div>
                    <div class="more-options">
                        <i class="fas fa-ellipsis-h"></i>
                    </div>
                </div>

                <!-- Card Image -->
                <img src="{{asset('assets/announcement/announcement.jpg')}}" class="post-image" alt="Announcement">

                <!-- Card Actions -->
                <div class="card-actions">
                    <div class="action-buttons">
                        <i class="far fa-heart me-3"></i>
                        <i class="far fa-comment me-3"></i>
                        <i class="far fa-paper-plane"></i>
                    </div>
                </div>

                <!-- Card Content -->
                <div class="card-content">
                    <h5 class="post-title">{{$announcement->title}}</h5>
                    <p class="post-text preview-text">{{Str::limit($announcement->content, 100)}}</p>
                    <div class="full-content" id="content-{{$announcement->id}}">
                        {{$announcement->content}}
                    </div>
                    <button onclick="toggleContent({{$announcement->id}})" class="read-more-btn">
                        Read more
                    </button>
                    <small class="post-date">{{$announcement->created_at->format('F d, Y')}}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    :root {
        --ig-border: #dbdbdb;
        --ig-text: #262626;
        --ig-secondary: #8e8e8e;
        --ig-background: #ffffff;
    }

    .instagram-card {
        background: var(--ig-background);
        border: 1px solid var(--ig-border);
        border-radius: 8px;
        margin-bottom: 24px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px;
        border-bottom: 1px solid var(--ig-border);
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
    }, { threshold: 0.1 });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.5s ease';
        observer.observe(card);
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@include('trainee.partials.footer')