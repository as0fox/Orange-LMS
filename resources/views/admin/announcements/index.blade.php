<?php $announcements_active = 'active'; 
$page = 'Announcements'; ?>
@include('admin.partials.header')

<!-- Add DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Manage Announcements</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
            <i class="fas fa-plus"></i> Add Announcement
        </button>
    </div>

    <!-- Success/Errors Alerts -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Announcements Table -->
    <div class="table-responsive">
        <table id="announcementsTable" class="table table-striped table-hover">
            <thead class="table-white">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Cohort</th>
                <th>Created By</th>
                <th>Created At</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
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
                    <form action="{{ route('announcements.toggleActive', $announcement->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-sm  {{ $announcement->is_active ? 'btn-success' : 'btn-danger' }}">
                                 
                                    <i class="{{  $announcement->is_active ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                                </button>
                            </form>

                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
    

                            <!-- Edit Button -->
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editAnnouncementModal{{ $announcement->id }}">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Delete Button -->
                            <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this announcement?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No announcements found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check me-2"></i>Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Announcement Modals -->
@foreach($announcements as $announcement)
    <div class="modal fade" id="editAnnouncementModal{{ $announcement->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('announcements.update', $announcement->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title{{ $announcement->id }}" class="form-label">Title</label>
                            <input type="text" name="title" id="title{{ $announcement->id }}" class="form-control" value="{{ $announcement->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="content{{ $announcement->id }}" class="form-label">Content</label>
                            <textarea name="content" id="content{{ $announcement->id }}" class="form-control" required>{{ $announcement->content }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="cohort_id{{ $announcement->id }}" class="form-label">Cohort</label>
                            <select name="cohort_id" id="cohort_id{{ $announcement->id }}" class="form-control" required>
                                @foreach($cohorts as $cohort)
                                    <option value="{{ $cohort->id }}" {{ $cohort->id == $announcement->cohort_id ? 'selected' : '' }}>
                                        {{ $cohort->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check me-2"></i>Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@include('admin.partials.footer')

<!-- Add jQuery, DataTables, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#announcementsTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search announcements..."
            }
        });
    });
</script>
