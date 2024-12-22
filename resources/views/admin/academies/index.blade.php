<?php $academies_active = 'active'; 
$page='Academies';?>
@include('admin.partials.header')

<!-- Add DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">


    <!-- Main Content Section -->
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Manage Academies</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAcademyModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <!-- Success/Errors Alerts -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Academies Table -->
        <table id="academiesTable" class="table table-striped table-bordered">
            <thead >
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($academies as $academy)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $academy->name }}</td>
                    <td>{{ $academy->address }}</td>
                    <td>
                        <!-- Edit Button -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editAcademyModal{{ $academy->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <!-- Delete Button -->
                        <!-- <form action="{{ route('academies.destroy', $academy->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form> -->
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No academies found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Academy Modal (Unchanged) -->
    <div class="modal fade" id="addAcademyModal" tabindex="-1" aria-labelledby="addAcademyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('academies.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAcademyModalLabel">Add Academy</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Academy Modals (Unchanged) -->
    @foreach($academies as $academy)
        <div class="modal fade" id="editAcademyModal{{ $academy->id }}" tabindex="-1" aria-labelledby="editAcademyModalLabel{{ $academy->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('academies.update', $academy->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editAcademyModalLabel{{ $academy->id }}">Edit Academy</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name{{ $academy->id }}" class="form-label">Name</label>
                                <input type="text" name="name" id="name{{ $academy->id }}" class="form-control" value="{{ $academy->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="address{{ $academy->id }}" class="form-label">Address</label>
                                <textarea name="address" id="address{{ $academy->id }}" class="form-control" rows="3" required>{{ $academy->address }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
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
    $(document).ready(function() {
        $('#academiesTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search academies..."
            },
            columnDefs: [{
                targets: 'no-sort',
                orderable: false
            }]
        });
    });
</script>
@include('admin.partials.footer')

