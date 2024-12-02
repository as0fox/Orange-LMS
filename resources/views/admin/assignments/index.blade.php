<?php $assignments_active = 'active'; ?>
@include('admin.partials.header')

<!-- Main Content -->
<main class="main-content">
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Assignments</li>
            </ol>
        </div>
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
                            <button class="nav-link text-danger" type="submit">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Manage Assignments</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAssignmentModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <!-- Success/Errors Alerts -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Assignments Table -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Deadline</th>
                <th>Academy</th>
                <th>Cohort</th>
                <th>Technology</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($assignments as $assignment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $assignment->title }}</td>
                    <td>{{ $assignment->description }}</td>
                    <td>{{ $assignment->deadline->format('d-m-Y H:i') }}</td>
                    <td>{{ $assignment->academy->name }}</td>
                    <td>{{ $assignment->cohort->name }}</td>
                    <td>{{ $assignment->technology->name }}</td>
                    <td>
                        <span class="badge {{ $assignment->active ? 'bg-success' : 'bg-danger' }}">
                            {{ $assignment->active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <button
                            class="btn btn-sm btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#editAssignmentModal{{ $assignment->id }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <form
                            action="{{ route('assignments.destroy', $assignment->id) }}"
                            method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No assignments found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Assignment Modal -->
    <div class="modal fade" id="addAssignmentModal" tabindex="-1" aria-labelledby="addAssignmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('assignments.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAssignmentModalLabel">Add Assignment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="datetime-local" name="deadline" id="deadline" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="academy_id" class="form-label">Academy</label>
                            <select name="academy_id" id="academy_id" class="form-control" required>
                                @foreach($academies as $academy)
                                    <option value="{{ $academy->id }}">{{ $academy->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cohort_id" class="form-label">Cohort</label>
                            <select name="cohort_id" id="cohort_id" class="form-control" required>
                                @foreach($cohorts as $cohort)
                                    <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="technology_id" class="form-label">Technology</label>
                            <select name="technology_id" id="technology_id" class="form-control" required>
                                @foreach($technologies as $technology)
                                    <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="active" class="form-label">Status</label>
                            <select name="active" id="active" class="form-control" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Assignment Modal -->
    @foreach($assignments as $assignment)
        <div class="modal fade" id="editAssignmentModal{{ $assignment->id }}" tabindex="-1" aria-labelledby="editAssignmentModalLabel{{ $assignment->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('assignments.update', $assignment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editAssignmentModalLabel{{ $assignment->id }}">Edit Assignment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" id="title" value="{{ $assignment->title }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" required>{{ $assignment->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="deadline" class="form-label">Deadline</label>
                                <input type="datetime-local" name="deadline" id="deadline" value="{{ $assignment->deadline->format('Y-m-d\TH:i') }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="academy_id" class="form-label">Academy</label>
                                <select name="academy_id" id="academy_id" class="form-control" required>
                                    @foreach($academies as $academy)
                                        <option value="{{ $academy->id }}" {{ $academy->id == $assignment->academy_id ? 'selected' : '' }}>
                                            {{ $academy->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cohort_id" class="form-label">Cohort</label>
                                <select name="cohort_id" id="cohort_id" class="form-control" required>
                                    @foreach($cohorts as $cohort)
                                        <option value="{{ $cohort->id }}" {{ $cohort->id == $assignment->cohort_id ? 'selected' : '' }}>
                                            {{ $cohort->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="technology_id" class="form-label">Technology</label>
                                <select name="technology_id" id="technology_id" class="form-control" required>
                                    @foreach($technologies as $technology)
                                        <option value="{{ $technology->id }}" {{ $technology->id == $assignment->technology_id ? 'selected' : '' }}>
                                            {{ $technology->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="active" class="form-label">Status</label>
                                <select name="active" id="active" class="form-control" required>
                                    <option value="1" {{ $assignment->active ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$assignment->active ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check"></i> Save
                            </button>
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
