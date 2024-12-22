<?php $technologies_active = 'active'; 
$page='Technologies';?>
@include('admin.partials.header')

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">


    <!-- Main Content Section -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Manage Technologies</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTechnologyModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <!-- Success/Errors Alerts -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Technologies Table -->
        <table id="technologiesTable" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($technologies as $technology)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($technology->image)
                            <img src="{{ asset('assets/' . $technology->image) }}" alt="" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $technology->name }}</td>
                    <td>{{ $technology->description }}</td>
                    <td>{{ $technology->start_date }}</td>
                    <td>
                        <!-- Edit Button -->
                        <button
                            class="btn btn-sm btn-warning me-2"
                            data-bs-toggle="modal"
                            data-bs-target="#editTechnologyModal{{ $technology->id }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>

                        <!-- Delete Button -->
                        <!-- <form
                            action="{{ route('technologies.destroy', $technology->id) }}"
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
                    <td colspan="6" class="text-center">No technologies found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Technology Modal -->
    <div class="modal fade" id="addTechnologyModal" tabindex="-1" aria-labelledby="addTechnologyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('technologies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTechnologyModalLabel">Add Technology</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" required>
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

    <!-- Edit Technology Modal -->
    @foreach($technologies as $technology)
        <div class="modal fade" id="editTechnologyModal{{ $technology->id }}" tabindex="-1" aria-labelledby="editTechnologyModalLabel{{ $technology->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('technologies.update', $technology->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTechnologyModalLabel{{ $technology->id }}">Edit Technology</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name{{ $technology->id }}" class="form-label">Name</label>
                                <input type="text" name="name" id="name{{ $technology->id }}" class="form-control" value="{{ $technology->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description{{ $technology->id }}" class="form-label">Description</label>
                                <textarea name="description" id="description{{ $technology->id }}" class="form-control" required>{{ $technology->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image{{ $technology->id }}" class="form-label">Image</label>
                                <input type="file" name="image" id="image{{ $technology->id }}" class="form-control" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label for="start_date{{ $technology->id }}" class="form-label">Start Date</label>
                                <input type="date" name="start_date" id="start_date{{ $technology->id }}" class="form-control" value="{{ $technology->start_date }}" required>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#technologiesTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search technologies..."
            },
            columnDefs: [{
                targets: 'no-sort',
                orderable: false
            }],
            order: [[2, 'asc']], // Sort by name column
            columns: [
                null,  // #
                { orderable: false },  // Image
                { type: 'string' },   // Name
                { type: 'string' },   // Description
                { type: 'date' },     // Start Date
                { orderable: false }  // Actions
            ]
        });

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

@include('admin.partials.footer')