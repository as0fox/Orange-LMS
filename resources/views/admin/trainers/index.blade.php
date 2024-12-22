<?php $trainers_active = 'active' ;
$page='Trainers';?>
@include('admin.partials.header')

<!-- Add DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">



    <!-- Main Content Section -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Manage Trainers</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTrainerModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <!-- Success/Errors Alerts -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Trainers Table -->
        <table id="trainersTable" class="table table-striped table-bordered">
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
            @forelse($trainers as $trainer)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($trainer->image)
                            <img src="{{ asset('assets/' . $trainer->image) }}" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;" />
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $trainer->name }}</td>
                    <td>{{ $trainer->email }}</td>
                    <td>{{ $trainer->academy->name ?? 'Unassigned' }}</td>
                    <td>
                        <!-- Toggle Active/Inactive Button -->
                        <button
                            class="btn btn-sm {{ $trainer->active ? 'btn-success' : 'btn-danger' }}"
                            onclick="event.preventDefault(); document.getElementById('toggle-active-form-{{ $trainer->id }}').submit();"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $trainer->active ? 'Deactivate' : 'Activate' }}">
                            <i class="{{ $trainer->active ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                        </button>

                        <form id="toggle-active-form-{{ $trainer->id }}"
                              action="{{ route('admin.trainers.toggle-active', $trainer->id) }}"
                              method="POST" style="display: none;">
                            @csrf
                        </form>
                    </td>
                    <td>
                        <!-- Edit Button -->
                        <button
                            class="btn btn-sm btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#editTrainerModal{{ $trainer->id }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Delete Button -->
                        <!-- <form
                            action="{{ route('admin.trainers.destroy', $trainer->id) }}"
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
                        </form> -->
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No trainers found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Trainer Modal -->
    <div class="modal fade" id="addTrainerModal" tabindex="-1" aria-labelledby="addTrainerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.trainers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTrainerModalLabel">Add Trainer</h5>
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
                                @foreach($academies as $academy)
                                    <option value="{{ $academy->id }}">{{ $academy->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <input type="file" name="image" id="image" class="form-control">
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

    <!-- Edit Trainer Modal -->
    @foreach($trainers as $trainer)
        <div class="modal fade" id="editTrainerModal{{ $trainer->id }}" tabindex="-1" aria-labelledby="editTrainerModalLabel{{ $trainer->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.trainers.update', $trainer->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTrainerModalLabel{{ $trainer->id }}">Edit Trainer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name{{ $trainer->id }}" class="form-label">Name</label>
                                <input type="text" name="name" id="name{{ $trainer->id }}" class="form-control" value="{{ $trainer->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email{{ $trainer->id }}" class="form-label">Email</label>
                                <input type="email" name="email" id="email{{ $trainer->id }}" class="form-control" value="{{ $trainer->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password{{ $trainer->id }}" class="form-label">Password</label>
                                <input type="password" name="password" id="password{{ $trainer->id }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="academy_id{{ $trainer->id }}" class="form-label">Academy</label>
                                <select name="academy_id" id="academy_id{{ $trainer->id }}" class="form-control" required>
                                    @foreach($academies as $academy)
                                        <option value="{{ $academy->id }}" {{ $trainer->academy_id == $academy->id ? 'selected' : '' }}>
                                            {{ $academy->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image{{ $trainer->id }}" class="form-label">Upload Image</label>
                                <input type="file" name="image" id="image{{ $trainer->id }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="active{{ $trainer->id }}" class="form-label">Active</label>
                                <select name="active" id="active{{ $trainer->id }}" class="form-control">
                                    <option value="1" {{ $trainer->active ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$trainer->active ? 'selected' : '' }}>Inactive</option>
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

<!-- Add DataTables JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    // Initialize DataTable
    $(document).ready(function() {
        $('#trainersTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search trainers..."
            },
            columnDefs: [{
                targets: 'no-sort',
                orderable: false
            }],
            order: [[2, 'asc']], // Sort by name column by default
            columns: [
                null,  // #
                { type: 'html', orderable: false },  // Image
                { type: 'string' },  // Name
                { type: 'string' },  // Email
                { type: 'string' },  // Academy
                { type: 'html', orderable: false },  // Active
                { orderable: false }  // Actions
            ]
        });
    });
</script>

@include('admin.partials.footer')