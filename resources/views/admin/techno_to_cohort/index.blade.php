<?php $technologiesToCohort_active="active";
$page='Assign Technologies'; ?>
@include('admin.partials.header')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-black fw-bold">Assign Technologies</h2>
    </div>

    <!-- Success/Errors Alerts -->
    @if (session('success'))
    <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @elseif (session('error'))
    <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
    @endif

    <!-- Filters -->
    <form method="GET" action="{{ route('techno_to_cohort.index') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="academy_id" class="form-label fw-semibold">Academy</label>
                <select name="academy_id" id="academy_id" class="form-select shadow-sm" onchange="this.form.submit()">
                    <option value="">Select Academy</option>
                    @foreach($academies as $academy)
                    <option value="{{ $academy->id }}" {{ request('academy_id') == $academy->id ? 'selected' : '' }}>
                        {{ $academy->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="cohort_id" class="form-label fw-semibold">Cohort</label>
                <select name="cohort_id" id="cohort_id" class="form-select shadow-sm" onchange="this.form.submit()">
                    <option value="">Select Cohort</option>
                    @foreach($cohorts as $cohort)
                    <option value="{{ $cohort->id }}" {{ request('cohort_id') == $cohort->id ? 'selected' : '' }}>
                        {{ $cohort->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <!-- Technologies Assignment Form -->
    <form method="POST" action="{{ route('techno_to_cohort.store') }}">
        @csrf
        <input type="hidden" name="academy_id" value="{{ request('academy_id') }}">
        <input type="hidden" name="cohort_id" value="{{ request('cohort_id') }}">

        <div class="card shadow-sm border-2">
            <div class="card-header bg-white text-black">
                <h4 class="mb-0 fw-bold">Available Technologies</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    @foreach($technologies as $technology)
                    <div class="col-md-6">
                        <div class="form-check mb-2">
                            <input type="checkbox" name="technologies[]" value="{{ $technology->id }}"
                                class="form-check-input shadow-sm" @if(request('cohort_id') &&
                                $selectedTechnologies->contains($technology->id)) checked @endif>
                            <label class="form-check-label fw-semibold text-secondary">
                                {{ $technology->name }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">Assign</button>
        </div>
    </form>

    <!-- Assigned Technologies Table -->
    <div class="mt-5">
        <h4 class="fw-bold mb-3">Assigned Technologies</h4>
        <table id="technologiesTable" class="table table-striped shadow-sm">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Cohort ID</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($technoToCohorts as $assignment)
                <tr>
                    <td><img src="{{ asset('assets/' . $assignment->technology->image )}}"
                            alt="{{ $assignment->technology->name }}" width="50"></td>
                    <td>{{ $assignment->technology->name }}</td>
                    <td>{{ $assignment->technology->description }}</td>
                    <td>{{ $assignment->cohort_id  }}</td>
                    <td>
                        <form method="POST" action="{{ route('techno_to_cohort.update', $assignment->id) }}">
                            @csrf
                            @method('PUT')
                            <input type="date" name="start_date" value="{{ $assignment->start_date }}"
                                class="form-control">
                    </td>
                    <td>
                        <input type="date" name="end_date" value="{{ $assignment->end_date }}" class="form-control">
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#technologiesTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search technologies..."
        },
        columns: [
            { orderable: false },  // Image
            { type: 'string' },    // Name
            { type: 'string' },    // Description
            { type: 'string' },    // Cohort ID
            { type: 'date' },      // Start Date
            { type: 'date' },      // End Date
            { orderable: false }   // Action
        ],
        order: [[1, 'asc']] // Sort by Name
    });
});


$(document).ready(function() {
    $('#assignedTechnologiesTable').DataTable({
        responsive: true,
        autoWidth: false,
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function(tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>

@include('admin.partials.footer')