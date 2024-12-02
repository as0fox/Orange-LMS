<?php $cohorts_active = 'active'; ?>
@include('admin.partials.header')

<!-- Main Content -->
<main class="main-content">
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Cohorts</li>
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
            <h2>Manage Cohorts</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCohortModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <!-- Success/Errors Alerts -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Cohorts Table -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Academy</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($cohorts as $cohort)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cohort->name }}</td>
                    <td>{{ $cohort->academy->name }}</td>
                    <td>{{ $cohort->start_date }}</td>
                    <td>{{ $cohort->end_date }}</td>
                    <td>
                        <!-- Toggle Active/Inactive Button -->
                        <button
                            class="btn btn-sm {{ $cohort->active ? 'btn-success' : 'btn-secondary' }}"
                            onclick="event.preventDefault(); document.getElementById('toggle-active-form-{{ $cohort->id }}').submit();"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $cohort->active ? 'Deactivate' : 'Activate' }}">
                            <i class="{{ $cohort->active ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </button>

                        <form id="toggle-active-form-{{ $cohort->id }}"
                              action="{{ route('admin.cohorts.toggle-active', $cohort->id) }}"
                              method="POST" style="display: none;">
                            @csrf
                        </form>
                    </td>
                    <td>
                        <!-- Edit Button -->
                        <button
                            class="btn btn-sm btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#editCohortModal{{ $cohort->id }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Delete Button -->
                        <form
                            action="{{ route('admin.cohorts.delete', $cohort->id) }}"
                            method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No cohorts found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Cohort Modal -->
    <div class="modal fade" id="addCohortModal" tabindex="-1" aria-labelledby="addCohortModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.cohorts.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCohortModalLabel">Add Cohort</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
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
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="active" class="form-label">Active</label>
                            <select name="active" id="active" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Cohort Modal -->
    @foreach($cohorts as $cohort)
        <div class="modal fade" id="editCohortModal{{ $cohort->id }}" tabindex="-1" aria-labelledby="editCohortModalLabel{{ $cohort->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.cohorts.update', $cohort->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCohortModalLabel{{ $cohort->id }}">Edit Cohort</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name{{ $cohort->id }}" class="form-label">Name</label>
                                <input type="text" name="name" id="name{{ $cohort->id }}" class="form-control" value="{{ $cohort->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="academy_id{{ $cohort->id }}" class="form-label">Academy</label>
                                <select name="academy_id" id="academy_id{{ $cohort->id }}" class="form-control" required>
                                    @foreach($academies as $academy)
                                        <option value="{{ $academy->id }}" {{ $academy->id == $cohort->academy_id ? 'selected' : '' }}>
                                            {{ $academy->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="start_date{{ $cohort->id }}" class="form-label">Start Date</label>
                                <input type="date" name="start_date" id="start_date{{ $cohort->id }}" class="form-control" value="{{ $cohort->start_date }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="end_date{{ $cohort->id }}" class="form-label">End Date</label>
                                <input type="date" name="end_date" id="end_date{{ $cohort->id }}" class="form-control" value="{{ $cohort->end_date }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="active{{ $cohort->id }}" class="form-label">Active</label>
                                <select name="active" id="active{{ $cohort->id }}" class="form-control">
                                    <option value="1" {{ $cohort->active ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$cohort->active ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i>
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check"></i>
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
