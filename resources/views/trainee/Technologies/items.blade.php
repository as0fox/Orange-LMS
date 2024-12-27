
<?php

$technology_active="active";
$page = 'technologies';

?>
@include('trainee.partials.header')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title ">
            <i class="fas fa-laptop-code me-2"></i>{{ $technology->name }}
        </h2>
        <a href="{{ route('technologies.index') }}" class="btn btn-outline-light">
            <i class="fas fa-arrow-left me-2"></i>Back
        </a>
    </div>

    <p class="text-muted mb-4">{{ $technology->description }}</p>

    <!-- Items Grid -->
    <div class="items-grid">
        @forelse ($items as $item)
        <div class="item-card">
            <div class="item-content">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="text-white">{{ $item->name }}</h5>
                    <span class="date-badge">
                        <i class="fas fa-calendar-alt me-1"></i>
                        {{ $item->created_at->format('M d') }}
                    </span>
                </div>
                
                <p class="text-muted mb-4">{{ $item->description }}</p>
                
                <div class="item-actions">
                    @if ($item->video)
                    <a href="{{ $item->video }}" target="_blank" class="action-button video-button">
                        <i class="fas fa-play-circle me-2"></i>Watch Video
                    </a>
                    @endif
                    
                    @if ($item->link)
                    <a href="{{ $item->link }}" target="_blank" class="action-button link-button">
                        <i class="fas fa-external-link-alt me-2"></i>View Resource
                    </a>
                    @endif
                    
                    @if ($item->file)
                    <a href="{{ asset($item->file) }}" download class="action-button file-button">
                        <i class="fas fa-download me-2"></i>Download
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="fas fa-folder-open fa-3x mb-3"></i>
            <p>No items available for this technology yet. Check back soon!</p>
        </div>
        @endforelse
    </div>
</div>

<style>
:root {
    --vibrant-orange: #ff7900;
    --dark-bg: #1a1a1a;
    --card-bg: #2a2a2a;
    --text-muted: #888;
}

body {
    background-color: var(--dark-bg);
    color: white;
}

.section-title {
    color: black;
    font-weight: 600;
}

.items-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
}

.item-card {
    background: var(--card-bg);
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
}

.item-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

.item-content {
    padding: 1.5rem;
}

.date-badge {
    background: rgba(255,255,255,0.1);
    color: var(--vibrant-orange);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
}

.item-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    margin-top: 1.5rem;
}

.action-button {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    text-decoration: none;
    transition: transform 0.2s ease;
    font-size: 0.875rem;
    display: inline-flex;
    align-items: center;
}

.action-button:hover {
    transform: scale(1.05);
}

.video-button {
    background: #ffc107;
    color: #000;
}

.link-button {
    background: var(--vibrant-orange);
    color: white;
}

.file-button {
    background: #28a745;
    color: white;
}

.empty-state {
    grid-column: 1 / -1;
    text-align: center;
    padding: 3rem;
    background: var(--card-bg);
    border-radius: 15px;
    color: var(--text-muted);
}

.btn-outline-light {
    border-color: rgba(255,255,255,0.2);
    color: white;
}

.btn-outline-light:hover {
    background: rgba(255,255,255,0.1);
    border-color: rgba(255,255,255,0.3);
    color: white;
}

.text-muted {
    color: var(--text-muted) !important;
}
</style>
<script>
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('active');
}

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


@include('trainee.partials.footer')
