<?php $submitted_assignments_active = 'active'; ?>
<?php $page = 'Submitted Assignments'; ?>
@include('admin.partials.header')

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<!-- Main Content Section -->
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Submitted Assignments</h2>
    </div>

    <!-- Success/Errors Alerts -->
    @if (session('success'))
    <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @elseif (session('error'))
    <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table id="submittedAssignmentsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Trainee Name</th>
                        <th>Assignment</th>
                        <th>Submission Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submittedAssignments as $assignment)
                    <tr>
                        <td>
                            @if($assignment->trainee->image)
                            <img src="{{ asset('assets/' . $assignment->trainee->image) }}"
                                alt="{{ $assignment->trainee->name }}" class="rounded-circle"
                                style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                            <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $assignment->trainee->name }}</td>
                        <td>{{ $assignment->assignment->title }}</td>
                        <td>{{ $assignment->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            @php
                            $statusClass = match($assignment->status) {
                            'pending' => 'warning',
                            'approved' => 'success',
                            'rejected' => 'danger',
                            default => 'secondary'
                            };
                            @endphp
                            <span class="badge bg-{{ $statusClass }}">{{ ucfirst($assignment->status) }}</span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info me-2" data-bs-toggle="modal"
                                data-bs-target="#viewDetailsModal" data-id="{{ $assignment->id }}"
                                data-trainee-name="{{ $assignment->trainee->name }}"
                                data-assignment-title="{{ $assignment->assignment->title }}"
                                data-submission-date="{{ $assignment->created_at->format('Y-m-d H:i') }}"
                                data-status="{{ $assignment->status }}"
                                data-trainee-image="{{ asset('assets/' . $assignment->trainee->image) }}"
                                data-submission-link="{{ $assignment->submission_link }}" 
                                title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDetailsModalLabel">Assignment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img id="traineeImage" src="" alt="Trainee Image" class="img-fluid rounded-circle"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                        <h4 id="traineeName"></h4>
                        <p><strong>Comment: </strong><span id="assignmentTitle"></span></p>
                        <p><strong>Submission Date: </strong><span id="submissionDate"></span></p>
                        <p><strong>Status: </strong><span id="status"></span></p>
                    </div>
                </div>
                <div class="mt-4">
                    <a id="goToAssignmentLink" href="#" class="btn btn-primary" target="_blank">Go to GitHub Link</a>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
// When the modal is triggered, populate its content
$('#viewDetailsModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var traineeImage = button.data('trainee-image');
    var traineeName = button.data('trainee-name');
    var assignmentTitle = button.data('assignment-title');
    var submissionDate = button.data('submission-date');
    var status = button.data('status');
    var assignmentId = button.data('id');
    var submissionLink = button.data('submission-link'); // Get the submission link

    // Populate the modal with data
    $('#traineeImage').attr('src', traineeImage);
    $('#traineeName').text(traineeName);
    $('#assignmentTitle').text(assignmentTitle);
    $('#submissionDate').text(submissionDate);
    $('#status').text(status.charAt(0).toUpperCase() + status.slice(1)); // Capitalize status
    $('#goToAssignmentLink').attr('href', submissionLink); // Set the link to submission_link
});




$(document).ready(function() {
    $('#submittedAssignmentsTable').DataTable({
        order: [
            [3, 'desc']
        ], // Sort by submission date by default
        pageLength: 10,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search submissions..."
        }
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function(tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>

@include('admin.partials.footer')