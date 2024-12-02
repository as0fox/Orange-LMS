<!-- resources/views/admin/absence_rules/index.blade.php -->

<?php $absences_rules_active = 'active'; ?>
@include('admin.partials.header')

<main class="main-content">
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Absence Rules</li>
            </ol>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Create Absence Rule Form -->
        <h2>Create Absence Rule</h2>
        <form method="POST" action="{{ route('admin.absence_rules.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="academy" class="form-label">Academy</label>
                    <select name="academy_id" id="academy" class="form-control" required>
                        <option value="">Select Academy</option>
                        @foreach($academies as $academy)
                            <option value="{{ $academy->id }}">{{ $academy->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="cohort" class="form-label">Cohort</label>
                    <select name="cohort_id" id="cohort" class="form-control" required>
                        <option value="">Select Cohort</option>
                        @foreach($cohorts as $cohort)
                            <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="max_days" class="form-label">Max Absences</label>
                    <input type="number" name="max_days" id="max_days" class="form-control" value="{{ old('max_days') }}" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save Rule</button>
        </form>

        <!-- Display Success/Error Messages -->
        @if (session('success'))
            <div class="alert alert-success mt-4">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger mt-4">{{ session('error') }}</div>
        @endif

        <!-- Absence Rules Table -->
        <h2 class="mt-5">Manage Absence Rules</h2>
        <form method="GET" action="{{ route('admin.absence_rules.index') }}">
            <div class="d-flex justify-content-between align-items-center mb-3">
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

        <!-- Absence Rules Table -->
        <table class="table table-striped table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Academy</th>
                    <th>Cohort</th>
                    <th>Max Absences</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($absenceRules as $rule)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rule->academy->name }}</td>
                    <td>{{ $rule->cohort->name }}</td>
                    <td>{{ $rule->max_days }}</td>
                    <td>
                        <!-- Action buttons for Edit, Delete -->
                        <a href="{{ route('admin.absence_rules.edit', $rule->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.absence_rules.destroy', $rule->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</main>

@include('admin.partials.footer')
