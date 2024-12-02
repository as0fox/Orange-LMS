<?php $jobCoaches_active = 'active'; ?>
@include('admin.partials.header')

<main class="main-content">
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Job Coaches</li>
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

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Manage Job Coaches</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addJobCoachModal">
                <i class="fas fa-plus"></i> Add Job Coach
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Academy</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($jobCoaches as $job_coach)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($job_coach->image)
                            <img src="{{ asset('assets/'. $job_coach->image ) }}" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" />
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $job_coach->name }}</td>
                    <td>{{ $job_coach->email }}</td>
                    <td>{{ $job_coach->academy->name ?? 'No Academy Assigned' }}</td>
                    <td>
                        <button class="btn btn-sm {{ $job_coach->active ? 'btn-success' : 'btn-danger' }}" onclick="event.preventDefault(); document.getElementById('toggle-active-form-{{ $job_coach->id }}').submit();">
                            <i class="{{ $job_coach->active ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </button>
                        <form id="toggle-active-form-{{ $job_coach->id }}" action="{{ route('jobCoaches.toggle-active', $job_coach->id) }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editJobCoachModal{{ $job_coach->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form action="{{ route('jobCoaches.destroy', $job_coach->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No job coaches found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Job Coach Modal -->
    <div class="modal fade" id="addJobCoachModal" tabindex="-1" aria-labelledby="addJobCoachModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('jobCoaches.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addJobCoachModalLabel">Add Job Coach</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="form-group mb-3">
                            <label for="academy_id">Academy</label>
                            <select class="form-control" id="academy_id" name="academy_id">
                                <option value="">Select Academy</option>
                                @foreach($academies as $academy)
                                    <option value="{{ $academy->id }}">{{ $academy->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Job Coach</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Job Coach Modal -->
    @foreach($jobCoaches as $job_coach)
    <div class="modal fade" id="editJobCoachModal{{ $job_coach->id }}" tabindex="-1" aria-labelledby="editJobCoachModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('jobCoaches.update', $job_coach->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editJobCoachModalLabel">Edit Job Coach</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $job_coach->name }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $job_coach->email }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if($job_coach->image)
                                <img src="{{ asset('assets/'. $job_coach->image ) }}" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" />
                            @else
                                <span>No Image</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="academy_id">Academy</label>
                            <select class="form-control" id="academy_id" name="academy_id">
                                <option value="">Select Academy</option>
                                @foreach($academies as $academy)
                                    <option value="{{ $academy->id }}" {{ $job_coach->academy_id == $academy->id ? 'selected' : '' }}>{{ $academy->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    </main>

    @include('admin.partials.footer')

