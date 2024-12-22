<?php $assignments_active = "active" ;
$page="Assignments ";
?>

@include('trainee.partials.header')

<div class="container py-4">
    <!-- Header Section -->
    <h2 class="section-title mb-4"><i class="fas fa-tasks me-2"></i>Assignments</h2>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="row">
            <div class="col-md-4">
                <select class="form-select" id="techFilter">
                    <option value="">All Technologies</option>
                    @foreach($technologies as $technology)
                    <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select" id="statusFilter">
                    <option value="">All Status</option>
                    <option value="submitted">Submitted</option>
                    <option value="pending">Pending</option>
                    <option value="late">Late</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" id="searchInput" placeholder="Search assignments...">
            </div>
        </div>
    </div>

    <!-- Assignments List -->
    <div class="assignments-list">
        @foreach($assignments as $assignment)
        @php
        $isDeadlinePassed = \Carbon\Carbon::parse($assignment->deadline)->isPast();
        @endphp
        <div class="assignment-card" data-technology="{{ $assignment->technology_id }}">
            <div class="assignment-header" onclick="toggleContent(this)">
                <div>
                    <h5 class="mb-0">{{ $assignment->title }}</h5>
                    <br>
                    <span class="tech-badge">{{ $assignment->technology->name }}</span>
                </div>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="assignment-content">
                <p>{{ $assignment->description }}</p>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="deadline">
                        <i class="fas fa-clock me-2"></i>
                        Due: {{ \Carbon\Carbon::parse($assignment->deadline)->format('M d, Y h:i A') }}
                    </span>

                    <button class="submit-btn <?= $isDeadlinePassed? 'bg-danger' : ''  ?>"
                        onclick="openSubmitModal('{{ $assignment->id }}', '{{ $assignment->title }}')"
                        {{ $isDeadlinePassed ? 'disabled' : '' }}>
                        <i
                            class="fas fa-upload me-2"></i>{{ $isDeadlinePassed ? 'Deadline Passed' : 'Submit Assignment' }}
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Submit Assignment Modal -->
<div class="modal" id="submitModal">
    <div class="modal-content">
        <button class="close-modal" onclick="closeSubmitModal()">×</button>
        <h4 class="mb-4 text-black">Submit Assignment</h4>
        <form id="submitForm" action="{{ route('trainee.submitassignment') }}" method="POST">
            @csrf
            <input type="hidden" name="assignment_id" id="assignmentId">
            <div class="mb-3">
                <label class="form-label text-black">Assignment Name</label>
                <input type="text" class="form-control" id="assignmentName" readonly>
            </div>
            <div class="mb-3">
                <label class="form-label text-black">Submission Link</label>
                <input type="url" class="form-control" name="submission_link"
                    placeholder="Enter your GitHub/project link" required>
            </div>
            <div class="mb-3">
                <label class="form-label text-black">Comments (Optional)</label>
                <textarea class="form-control" name="comments" rows="3"
                    placeholder="Any additional comments..."></textarea>
            </div>
            <button class="submit-btn "
                onclick="openSubmitModal('{{ $assignment->id }}', '{{ $assignment->title }}')">
                <i class="fas fa-upload me-2"></i>{{ 'Submit Assignment' }}
            </button>

        </form>
    </div>
</div>

</main>

<script>
function toggleContent(header) {
    const content = header.nextElementSibling;
    const icon = header.querySelector('.fa-chevron-down');
    content.classList.toggle('show');
    icon.style.transform = content.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0)';
}

function openSubmitModal(assignmentId, assignmentName) {
    const modal = document.getElementById('submitModal');
    const assignmentNameInput = document.getElementById('assignmentName');
    const assignmentIdInput = document.getElementById('assignmentId');

    modal.classList.add('show');
    assignmentNameInput.value = assignmentName; // Populate the assignment name
    assignmentIdInput.value = assignmentId; // Populate the assignment ID
}


function closeSubmitModal() {
    const modal = document.getElementById('submitModal');
    modal.classList.remove('show');
}

// Close modal when clicking outside
document.getElementById('submitModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeSubmitModal();
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const techFilter = document.getElementById("techFilter");
    const statusFilter = document.getElementById("statusFilter");
    const searchInput = document.getElementById("searchInput");
    const assignmentCards = document.querySelectorAll(".assignment-card");

    // Function to filter assignments
    function filterAssignments() {
        const selectedTech = techFilter.value.toLowerCase();
        const selectedStatus = statusFilter.value.toLowerCase();
        const searchQuery = searchInput.value.toLowerCase();

        assignmentCards.forEach((card) => {
            const techId = card.getAttribute("data-technology").toLowerCase();
            const title = card.querySelector(".assignment-header h5").textContent.toLowerCase();
            const isSubmitted = card.querySelector(".submit-btn").disabled;
            const status = isSubmitted ? "submitted" : "pending";

            const matchesTech = !selectedTech || techId === selectedTech;
            const matchesStatus = !selectedStatus || status === selectedStatus;
            const matchesSearch = !searchQuery || title.includes(searchQuery);

            if (matchesTech && matchesStatus && matchesSearch) {
                card.style.display = "block";
            } else {
                card.style.display = "none";
            }
        });
    }

    // Add event listeners to filters
    techFilter.addEventListener("change", filterAssignments);
    statusFilter.addEventListener("change", filterAssignments);
    searchInput.addEventListener("input", filterAssignments);
});
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('active');
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@include('trainee.partials.footer')