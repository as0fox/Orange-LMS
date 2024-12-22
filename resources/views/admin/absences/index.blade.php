<?php $absences_active = 'active';
$page = 'Absence'; ?>
@include('admin.partials.header')

<div class="container mt-4">



    <!-- Success/Error Messages -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Mark Absence Button -->
    <div class="d-flex justify-content-end mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#absenceModal">
            <i class="fas fa-plus"></i> Mark Absence
        </button>
    </div>

    <!-- Existing Absences Table  & Filter Section -->
    <form method="GET" action="{{ route('absences.index') }}">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Manage Absences</h2>

            <!-- Filter Inputs -->
            <div class="d-flex">
                <div class="me-3">
                    <label for="academy" class="form-label">Academy</label>
                    <select name="academy" id="academy" class="form-control" onchange="this.form.submit()">
                        <option value="">Select Academy</option>
                        @foreach($academies as $academy)
                        <option value="{{ $academy->id }}" {{ request('academy') == $academy->id ? 'selected' : '' }}>
                            {{ $academy->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="me-3">
                    <label for="cohort" class="form-label">Cohort</label>
                    <select name="cohort" id="cohort" class="form-control" onchange="this.form.submit()">
                        <option value="">Select Cohort</option>
                        @foreach($cohorts as $cohort)
                        <option value="{{ $cohort->id }}" {{ request('cohort') == $cohort->id ? 'selected' : '' }}>
                            {{ $cohort->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table id="existingAbsencesTable" class="table table-striped table-bordered">
            <thead class="table-white">
                <tr>
                    <th>#</th>
                    <th>Trainee</th>
                    <th>Reason</th>
                    <th>Absence Type</th>
                    <th>Date Requested</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absences as $absence)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $absence->trainee->name }}</td>
                    <td>{{ $absence->reason ?: 'N/A' }}</td>
                    <td>
                        @if ($absence->absence_type == 'Excused')
                        <span class="absence-type-badge absence-type-excused">Excused</span>
                        @elseif ($absence->absence_type == 'Unexcused')
                        <span class="absence-type-badge absence-type-unexcused">Unexcused</span>
                        @elseif ($absence->absence_type == 'Delay')
                        <span class="absence-type-badge absence-type-delay">Delay</span>
                        @else
                        <span class="absence-type-badge absence-type-unknown">Unknown</span>
                        @endif
                    </td>

                    <td>{{ $absence->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        @if ($absence->status == 'Pending')
                        <span class="status-badge status-badge-pending">Pending</span>

                        @elseif ($absence->status == 'Approved')
                        <span class="status-badge status-badge-approved">Approved</span>

                        @elseif ($absence->status == 'Rejected')
                        <span class="status-badge status-badge-rejected">Rejected</span>

                        @else
                        <span class="status-badge status-badge-unknown">Unknown</span>

                        @endif
                    </td>

                    <td>
                        @if($absence->status == 'Pending')
                        <a href="{{ route('absences.edit', $absence->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        @else
                        <span class="text-muted">No Action</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Absence Modal -->
    <div class="modal fade" id="absenceModal" tabindex="-1" aria-labelledby="absenceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="absenceModalLabel">Mark Absence</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('absences.store') }}" method="POST" id="absenceForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="trainee_id" class="form-label">Select Trainee</label>
                            <select name="trainee_id" id="trainee_id" class="form-control" required>
                                <option value="">Select Trainee</option>
                                @foreach($trainees as $trainee)
                                <?php $maxAbsence = $trainee->cohort ? $trainee->cohort->max_absence : 0; ?>
                                <option value="{{ $trainee->id }}" data-absences="{{ $trainee->absences_count }}"
                                    data-max-absences="{{ $maxAbsence }}">
                                    {{ $trainee->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3" id="absence_count_display" style="display: none;">
                            <label class="form-label">Current Absences</label>
                            <div class="alert alert-info">
                                <span id="current_absences">0</span> / <span id="max_absences">0</span> absences
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="absence_type" class="form-label">Absence Type</label>
                            <select name="absence_type" id="absence_type" class="form-control" required>
                                <option value="">Select Absence Type</option>
                                <option value="Excused">Excused</option>
                                <option value="Unexcused">Unexcused</option>
                                <option value="Delay">Delay</option>
                            </select>
                        </div>

                        <div class="mb-3" id="reason_input" style="display: none;">
                            <label for="reason" class="form-label">Reason</label>
                            <input type="text" name="reason" id="reason" class="form-control"
                                placeholder="Enter reason for excused absence">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Mark Absence</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Absence Modal -->
<div class="modal fade" id="editAbsenceModal" tabindex="-1" aria-labelledby="editAbsenceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAbsenceModalLabel">Edit Absence</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('absences.update', ':id') }}" method="POST" id="editAbsenceForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_absence_type" class="form-label">Absence Type</label>
                        <select name="absence_type" id="edit_absence_type" class="form-control" required>
                            <option value="Excused">Excused</option>
                            <option value="Unexcused">Unexcused</option>
                            <option value="Delay">Delay</option>
                        </select>
                    </div>

                    <div class="mb-3" id="edit_reason_input" style="display: none;">
                        <label for="edit_reason" class="form-label">Reason</label>
                        <input type="text" name="reason" id="edit_reason" class="form-control"
                            placeholder="Enter reason for excused absence">
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select name="status" id="edit_status" class="form-control" required>
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">
<style>
.badge {
    font-size: 0.9em;
    padding: 0.5em 1em;
}

.table-responsive {
    margin-bottom: 2rem;
}

.dt-buttons {
    margin-bottom: 1rem;
}

.dt-buttons .btn {
    margin-right: 0.5rem;
}
</style>


<!-- Required DataTables files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<!-- Export Buttons -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script>
$(document).on('click', '.edit-absence-btn', function() {
    const absenceId = $(this).data('id');
    const absenceType = $(this).data('type');
    const reason = $(this).data('reason');
    const status = $(this).data('status');

    // Set form action URL dynamically
    const actionUrl = $('#editAbsenceForm').attr('action').replace(':id', absenceId);
    $('#editAbsenceForm').attr('action', actionUrl);

    // Populate form fields
    $('#edit_absence_type').val(absenceType).change();
    $('#edit_reason').val(reason || '');
    $('#edit_status').val(status).change();

    // Show or hide the reason input
    if (absenceType === 'Excused') {
        $('#edit_reason_input').show();
    } else {
        $('#edit_reason_input').hide();
    }

    // Show the modal
    $('#editAbsenceModal').modal('show');
});

// Toggle reason input in the Edit Modal based on absence type
$('#edit_absence_type').change(function() {
    if ($(this).val() === 'Excused') {
        $('#edit_reason_input').show();
    } else {
        $('#edit_reason_input').hide();
        $('#edit_reason').val(''); // Clear the reason input
    }
});



$(document).ready(function() {
    // Initialize DataTable with export buttons
    $('#existingAbsencesTable').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copy',
                className: 'export-btn export-btn-copy',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5] // Exclude actions column
                }
            },
            {
                extend: 'excel',
                className: 'export-btn export-btn-excel',
                title: 'Absences Report',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdf',
                className: 'export-btn export-btn-pdf',
                title: 'Absences Report',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'print',
                className: 'export-btn export-btn-print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }
        ],
        order: [
            [4, 'desc']
        ], // Sort by date requested by default
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search absences...",
            lengthMenu: "Show _MENU_ entries per page",
            info: "Showing _START_ to _END_ of _TOTAL_ absences",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            }
        },
        columnDefs: [{
                orderable: false,
                targets: [-1]
            }, // Disable sorting on action column
            {
                targets: 3, // Absence Type column
                render: function(data, type, row) {
                    return `<span class="badge ">${data}</span>`;
                }
            },
            {
                targets: 5, // Status column
                render: function(data, type, row) {

                    return `<span class="badge">${data}</span>`;
                }
            }
        ]
    });


});
</script>

<script>
$(document).ready(function() {


    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert:not(#absence_count_display .alert)').alert('close');
    }, 5000);

    // Handle trainee selection
    $('#trainee_id').change(function() {
        const selectedOption = $(this).find('option:selected');
        const absences = selectedOption.data('absences');
        const maxAbsences = selectedOption.data('max-absences');

        if (selectedOption.val()) {
            $('#current_absences').text(absences);
            $('#max_absences').text(maxAbsences);
            $('#absence_count_display').show();

            if (absences >= maxAbsences) {
                $('#absence_count_display .alert')
                    .removeClass('alert-info')
                    .addClass('alert-danger');
            } else {
                $('#absence_count_display .alert')
                    .removeClass('alert-danger')
                    .addClass('alert-info');
            }
        } else {
            $('#absence_count_display').hide();
        }
    });
});

// Handle Modal Events
document.addEventListener('DOMContentLoaded', function() {
    const absenceModal = document.getElementById('absenceModal');
    const absenceForm = document.getElementById('absenceForm');
    const absenceTypeSelect = document.getElementById('absence_type');
    const reasonInput = document.getElementById('reason_input');

    // Reset form when modal is closed
    absenceModal.addEventListener('hidden.bs.modal', function() {
        absenceForm.reset();
        reasonInput.style.display = 'none';
        document.getElementById('absence_count_display').style.display = 'none';
    });

    // Toggle reason input based on absence type
    absenceTypeSelect.addEventListener('change', function() {
        reasonInput.style.display = this.value === 'Excused' ? 'block' : 'none';
        if (this.value !== 'Excused') {
            document.getElementById('reason').value = '';
        }
    });

    // Form validation before submit
    absenceForm.addEventListener('submit', function(event) {
        const selectedTrainee = document.getElementById('trainee_id');
        const selectedOption = selectedTrainee.options[selectedTrainee.selectedIndex];
        const absences = parseInt(selectedOption.dataset.absences);
        const maxAbsences = parseInt(selectedOption.dataset.maxAbsences);

        if (!selectedTrainee.value) {
            event.preventDefault();
            alert('Please select a trainee');
            return;
        }

        if (absences >= maxAbsences) {
            if (!confirm(
                    'This trainee has reached the maximum number of absences. Do you want to continue?'
                )) {
                event.preventDefault();
                return;
            }
        }

        if (absenceTypeSelect.value === 'Excused' && !document.getElementById('reason').value.trim()) {
            event.preventDefault();
            alert('Please provide a reason for excused absence');
        }
    });
});
</script>


@include('admin.partials.footer')