<?php $classrooms_active = 'active' ?>

@include('admin.partials.header')

<!-- Main Content -->
<main class="main-content">
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Classrooms</li>
            </ol>

            <div class="d-flex align-items-center ms-auto">
                <div class="position-relative me-3">
                    <input type="search" class="form-control" placeholder="Search...">
                    <i class="fas fa-search position-absolute top-50 end-0 translate-middle-y me-2"></i>
                </div>
                <div class="dropdown">
                    <a href="#" class="nav-link" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="nav-link text-black" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="nav-link text-danger" type="submit" >
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Manage Classrooms</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClassroomModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <!-- Success/Errors Alerts -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Classrooms Table -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Cohort</th>
                <th>Trainer</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($classrooms as $classroom)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $classroom->name }}</td>
                    <td>{{ $classroom->cohort->name }}</td>
                    <td>{{ $classroom->trainer->name }}</td>
                    <td>{{ $classroom->active ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <!-- Toggle Active/Inactive Button -->
                        <button
                            class="btn btn-sm {{ $classroom->active ? 'btn-success' : 'btn-danger' }}"
                            onclick="event.preventDefault(); document.getElementById('toggle-active-form-{{ $classroom->id }}').submit();"
                            data-bs-toggle="tooltip" title="{{ $classroom->active ? 'Deactivate' : 'Activate' }}">
                            <i class="{{ $classroom->active ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </button>
                        <form id="toggle-active-form-{{ $classroom->id }}" action="{{ route('admin.classrooms.toggle-active', $classroom->id) }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <!-- Edit Button -->
                        <button
                            class="btn btn-sm btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#editClassroomModal-{{ $classroom->id }}"
                            data-bs-toggle="tooltip" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('admin.classrooms.delete', $classroom->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" data-bs-toggle="tooltip" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                        <!-- Restore Button -->
                        @if($classroom->is_deleted)
                            <form action="{{ route('admin.classrooms.restore', $classroom->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Restore">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Classroom Modal -->
    <div class="modal fade" id="addClassroomModal" tabindex="-1" aria-labelledby="addClassroomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.classrooms.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addClassroomModalLabel">Add Classroom</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Classroom Name</label>
                            <select name="name" id="name" class="form-control" required>
                                @foreach(range('A', 'Z') as $letter)
                                    <option value="{{ $letter }}">{{ $letter }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cohort" class="form-label">Cohort</label>
                            <select name="cohort_id" id="cohort" class="form-control" required>
                                @foreach($cohorts as $cohort)
                                    <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="trainer" class="form-label">Trainer</label>
                            <select name="trainer_id" id="trainer" class="form-control" required>
                                @foreach($trainers as $trainer)
                                    <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Classroom Modals -->
    @foreach($classrooms as $classroom)
        <div class="modal fade" id="editClassroomModal-{{ $classroom->id }}" tabindex="-1" aria-labelledby="editClassroomModalLabel-{{ $classroom->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.classrooms.update', $classroom->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editClassroomModalLabel-{{ $classroom->id }}">Edit Classroom</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name-{{ $classroom->id }}" class="form-label">Classroom Name</label>
                                <select name="name" id="name-{{ $classroom->id }}" class="form-control" required>
                                    @foreach(range('A', 'Z') as $letter)
                                        <option value="{{ $letter }}" {{ $classroom->name === $letter ? 'selected' : '' }}>
                                            {{ $letter }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cohort-{{ $classroom->id }}" class="form-label">Cohort</label>
                                <select name="cohort_id" id="cohort-{{ $classroom->id }}" class="form-control" required>
                                    @foreach($cohorts as $cohort)
                                        <option value="{{ $cohort->id }}" {{ $classroom->cohort_id == $cohort->id ? 'selected' : '' }}>
                                            {{ $cohort->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="trainer-{{ $classroom->id }}" class="form-label">Trainer</label>
                                <select name="trainer_id" id="trainer-{{ $classroom->id }}" class="form-control" required>
                                    @foreach($trainers as $trainer)
                                        <option value="{{ $trainer->id }}" {{ $classroom->trainer_id == $trainer->id ? 'selected' : '' }}>
                                            {{ $trainer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@include('admin.partials.footer')
