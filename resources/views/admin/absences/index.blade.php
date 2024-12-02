<?php $absences_active = 'active'; ?>
@include('admin.partials.header')

<main class="main-content">
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Absences</li>
            </ol>
        </div>
    </nav>

    <!-- Filter Section -->
    <div class="container mt-4">
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

        <!-- Success/Errors Alerts -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Table 1: Trainees Table (Mark Absences) -->
        <h3 class="mt-4">Trainees and Absence Requests</h3>
        <table class="table table-striped table-bordered" style="text-align: center; ">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Trainee</th>
            <th>Absences</th>
            <th>Reason</th>
        </tr>
    </thead>
    <tbody>
        @foreach($trainees as $trainee)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $trainee->name }}</td>
                <td>{{ $trainee->absences_count }}</td>
                <td colspan="2">
                    @if ($trainee->absences_count < 6)
                        <form action="{{ route('absences.store') }}" method="POST" style="display:flex; justify-content:space-between;">
                            @csrf
                            <input type="hidden" name="trainee_id" value="{{ $trainee->id }}">
                            <input type="text" name="reason" class="form-control mb-2" placeholder="Reason for absence" required style="max-width: 50%;">
                            <button type="submit" class="btn btn-sm btn-warning" required style="width: 25%; height:25%;">
                                <i class="fas fa-times"></i> Mark Absence
                            </button>
                        </form>
                    @else
                        <span class="badge bg-danger">Max Absences Reached</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>



        <!-- Table 2: Existing Absences (View & Edit Absence Details) -->
         <!-- Table 2: Existing Absences (DataTables Implementation) -->
    <h3 class="mt-4">Existing Absences</h3>
    <table id="existingAbsencesTable" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Trainee</th>
                <th>Reason</th>
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
                    <td>{{ $absence->reason }}</td>
                    <td>{{ $absence->created_at }}</td>
                    <td>
                        <span class="badge bg-{{ $absence->status == 'Approved' ? 'success' : ($absence->status == 'Rejected' ? 'danger' : 'warning') }}">
                            {{ $absence->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('absences.edit', $absence->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</main>
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#existingAbsencesTable').DataTable({
        // DataTables initialization options
        language: {
            // Customize language strings
            search: "_INPUT_",
            searchPlaceholder: "Search absences...",
            lengthMenu: "Show _MENU_ entries",
            paginate: {
                first: "First",
                last: "Last",
                next: "Next",
                previous: "Previous"
            }
        },
        // Maintain Bootstrap styling
        drawCallback: function() {
            // Add Bootstrap classes to DataTable elements
            $('.dataTables_wrapper .pagination').addClass('pagination-sm');
            $('.dataTables_wrapper .pagination .page-item').addClass('page-link');
        },
        // Optional: Custom column configurations
        columnDefs: [
            { 
                targets: [-1], // Last column (Actions)
                orderable: false // Disable sorting on action column
            },
            {
                targets: [4], // Status column
                render: function(data, type, row) {
                    // Keep the existing badge styling
                    return type === 'display' 
                        ? '<span class="badge bg-' + 
                          (data.includes('Approved') ? 'success' : 
                           (data.includes('Rejected') ? 'danger' : 'warning')) + 
                          '">' + data + '</span>'
                        : data;
                }
            }
        ]
    });
});
</script>

@include('admin.partials.footer')
