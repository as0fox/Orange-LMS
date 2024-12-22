<?php $absences_rules_active = 'active'; 
$page='Absence Rules'; ?>

@include('admin.partials.header')



    <div class="container mt-4"">
        <div class=" d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Max Absences</h2>
    </div>

    <!-- Filter Form -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.absence_rules.index') }}">
                <div class="d-flex align-items-center mb-4">
                    <label for="academy" class="me-2">Filter by Academy:</label>
                    <select name="academy" id="academy" onchange="this.form.submit()" class="form-control w-auto">
                        <option value="">All Academies</option>
                        @foreach($academies as $academy)
                        <option value="{{ $academy->id }}" {{ request('academy') == $academy->id ? 'selected' : '' }}>
                            {{ $academy->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Cohorts Table -->
    <div class="card">
        <div class="card-body">
            <table id="absencesTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Academy</th>
                        <th>Cohort Name</th>
                        <th>Max Absences</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cohorts as $cohort)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cohort->academy->name }}</td>
                        <td>{{ $cohort->name }}</td>
                        <td>
                            <!-- Inline Edit Form -->
                            <form method="POST" action="{{ route('admin.absence_rules.update', $cohort->id) }}"
                                class="d-flex align-items-center">
                                @csrf
                                @method('PUT')
                                <input type="number" name="max_absence" class="form-control w-50 me-2"
                                    value="{{ $cohort->max_absence }}" min="1" max="10" required>
                                <button type="submit" class="btn btn-success btn-sm">
                                    <i class="fas fa-save"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
</main>

<!-- Add jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#absencesTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search absence rules..."
        },
        columnDefs: [{
            targets: 'no-sort',
            orderable: false
        }],
        order: [
            [1, 'asc']
        ], // Sort by academy name
        columns: [
            null, // #
            {
                type: 'string'
            }, // Academy
            {
                type: 'string'
            }, // Cohort Name
            {
                orderable: false
            } // Max Absences
        ]
    });

    // Academy filter functionality
    $('#academy').on('change', function() {
        var selectedAcademy = $(this).val();
        $('#absencesTable').DataTable().column(1).search(
            selectedAcademy ? '^' + selectedAcademy + '$' : '',
            true,
            false
        ).draw();
    });
});
</script>

@include('admin.partials.footer')