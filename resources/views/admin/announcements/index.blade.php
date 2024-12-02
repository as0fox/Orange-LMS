<?php $announcements_active = 'active'; ?>
@include('admin.partials.header')

<main class="main-content">
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Announcements</li>
            </ol>
        </div>
        <div class="d-flex align-items-center ms-auto">
            <div class="position-relative me-3">
                <input type="search" class="form-control" placeholder="Search...">
                <i class="fas fa-search position-absolute top-50 end-0 translate-middle-y me-2"></i>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Manage Announcements</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <!-- Success/Errors Alerts -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Announcements Table -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Cohort</th>
                <th>Created By</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($announcements as $announcement)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $announcement->title }}</td>
                    <td>{{ Str::limit($announcement->content, 50) }}</td>
                    <td>{{ $announcement->cohort->name }}</td>
                    <td>{{ $announcement->created_by }}</td>
                    <td>{{ $announcement->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editAnnouncementModal{{ $announcement->id }}">
                            <i class="fas fa-edit"></i>
                        </button>

                        <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" style="display:inline-block;">
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
                    <td colspan="7" class="text-center">No announcements found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Announcement Modal -->
    <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('announcements.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAnnouncementModalLabel">Add Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" id="content" class="form-control" required></textarea>
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
                            <label for="created_by" class="form-label">Created By</label>
                            <select name="created_by" id="created_by" class="form-control" required>
                                <option value="Manager">Manager</option>
                                <option value="Trainer">Trainer</option>
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
</main>

@include('admin.partials.footer')
