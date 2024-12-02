<?php $managers_active = 'active' ?>
@include('admin.partials.header')

<!-- Main Content -->
<main class="main-content">
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Managers</li>
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
            <h2>Manage Managers</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addManagerModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <!-- Success/Errors Alerts -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Managers Table -->
        <table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Academy</th> <!-- New Column for Academy -->
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($managers as $manager)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if($manager->image)
                    <img src="{{ asset('assets/' . $manager->image) }}" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" />
                @else
                    <span>No Image</span>
                @endif
            </td>
            <td>{{ $manager->name }}</td>
            <td>{{ $manager->email }}</td>
            <td>{{ $manager->academy ? $manager->academy->name : 'No Academy' }}</td> <!-- Display Academy Name -->
            <td>
                <!-- Toggle Active/Inactive Button -->
                <button
                    class="btn btn-sm {{ $manager->active ? 'btn-success' : 'btn-danger' }}"
                    onclick="event.preventDefault(); document.getElementById('toggle-active-form-{{ $manager->id }}').submit();"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $manager->active ? 'Deactivate' : 'Activate' }}">
                    <i class="{{ $manager->active ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                </button>

                <form id="toggle-active-form-{{ $manager->id }}"
                      action="{{ route('managers.toggle-active', $manager->id) }}"
                      method="POST" style="display: none;">
                    @csrf
                </form>

                <!-- Edit Button -->
                <button
                    class="btn btn-sm btn-warning"
                    data-bs-toggle="modal"
                    data-bs-target="#editManagerModal{{ $manager->id }}"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                    <i class="fas fa-edit"></i>
                </button>

                <!-- Delete Button -->
                <form
                    action="{{ route('managers.destroy', $manager->id) }}"
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
            <td colspan="6" class="text-center">No managers found.</td>
        </tr>
    @endforelse
    </tbody>
</table>

    </div>

    <!-- Add Manager Modal -->
    <div class="modal fade" id="addManagerModal" tabindex="-1" aria-labelledby="addManagerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('managers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addManagerModalLabel">Add Manager</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="academy_id" class="form-label">Academy</label>
                            <select name="academy_id" id="academy_id" class="form-control" required>
                                <option value="" disabled selected>Select Academy</option>
                                @foreach($academies as $academy)
                                    <option value="{{ $academy->id }}">{{ $academy->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <input type="file" name="image" id="image" class="form-control">
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

    <!-- Edit Manager Modal -->
    @foreach($managers as $manager)
        <div class="modal fade" id="editManagerModal{{ $manager->id }}" tabindex="-1" aria-labelledby="editManagerModalLabel{{ $manager->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('managers.update', $manager->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editManagerModalLabel{{ $manager->id }}">Edit Manager</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name{{ $manager->id }}" class="form-label">Name</label>
                                <input type="text" name="name" id="name{{ $manager->id }}" class="form-control" value="{{ $manager->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email{{ $manager->id }}" class="form-label">Email</label>
                                <input type="email" name="email" id="email{{ $manager->id }}" class="form-control" value="{{ $manager->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password{{ $manager->id }}" class="form-label">Password</label>
                                <input type="password" name="password" id="password{{ $manager->id }}" class="form-control" placeholder="Leave blank to keep current password">
                            </div>
                            <div class="mb-3">
                                <label for="academy_id" class="form-label">Academy</label>
                                <select name="academy_id" id="academy_id" class="form-control" required>
                                    <option value="" disabled selected>Select Academy</option>
                                    @foreach($academies as $academy)
                                        <option value="{{ $academy->id }}" {{ $manager->academy_id == $academy->id ? 'selected' : '' }}>
                                            {{ $academy->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image{{ $manager->id }}" class="form-label">Upload Image</label>
                                <input type="file" name="image" id="image{{ $manager->id }}" class="form-control">
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
