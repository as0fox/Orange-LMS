<?php $managers_active = 'active'; ?>
<?php $page = 'Managers'; ?>
@include('admin.partials.header')

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

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
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
    @endif

    <table id="managersTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Academy</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($managers as $manager)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($manager->image)
                            <img src="{{ asset('assets/' . $manager->image) }}" alt="" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $manager->name }}</td>
                    <td>{{ $manager->email }}</td>
                    <td>{{ $manager->academy ? $manager->academy->name : 'No Academy' }}</td>
                    <!-- Toggle Active Button -->
                    <td>
                        <form id="toggle-active-form-{{ $manager->id }}" action="{{ route('managers.toggle-active', $manager->id) }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="btn btn-sm {{ $manager->active ? 'btn-success' : 'btn-danger' }}"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                title="{{ $manager->active ? 'Deactivate' : 'Activate' }}">
                                <i class="{{ $manager->active ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                            </button>
                        </form>
                    </td>
                    <td class="d-flex justify-content-center">
                        <!-- Edit Button -->
                        <button
                            class="btn btn-sm btn-warning me-2"
                            data-bs-toggle="modal"
                            data-bs-target="#editManagerModal{{ $manager->id }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No managers found.</td>
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

<!-- Edit Manager Modals (Dynamically generated for each manager) -->
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
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $manager->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $manager->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password (Leave empty to keep current)</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="academy_id" class="form-label">Academy</label>
                            <select name="academy_id" id="academy_id" class="form-control" required>
                                <option value="" disabled>Select Academy</option>
                                @foreach($academies as $academy)
                                    <option value="{{ $academy->id }}" {{ $academy->id == $manager->academy_id ? 'selected' : '' }}>{{ $academy->name }}</option>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#managersTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search managers..."
            },
            columns: [
                null,  // #
                { orderable: false },  // Image
                { type: 'string' },   // Name
                { type: 'string' },   // Email
                { type: 'string' },   // Academy
                { orderable: false }, // Active
                { orderable: false }  // Actions
            ],
            order: [[2, 'asc']] // Sort by name column
        });

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@include('admin.partials.footer')
