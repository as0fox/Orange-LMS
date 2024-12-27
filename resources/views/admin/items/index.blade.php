<?php $items_active = 'active'; ?>
<?php $page = 'Items'; ?>
@include('admin.partials.header')

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<!-- Main Content Section -->
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Manage Items</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">
            <i class="fas fa-plus"></i> Add Item
        </button>
    </div>

    <!-- Success/Errors Alerts -->
    @if (session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
    @endif

    <table id="itemsTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Video</th>
                <th>Link</th>
                <th>File</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->video ? 'Available' : 'No Video' }}</td>
                    <td>{{ $item->link ? 'Available' : 'No Link' }}</td>
                    <td>{{ $item->file ? 'Uploaded' : 'No File' }}</td>
                    <td>
                        <form id="toggle-active-form-{{ $item->id }}" action="{{ route('items.toggle-active', $item->id) }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="btn btn-sm {{ $item->active ? 'btn-success' : 'btn-danger' }}"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                title="{{ $item->active ? 'Deactivate' : 'Activate' }}">
                                <i class="{{ $item->active ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                            </button>
                        </form>
                    </td>
                    <td class="d-flex justify-content-center">
                        <!-- Edit Button -->
                        <button
                            class="btn btn-sm btn-warning me-2"
                            data-bs-toggle="modal"
                            data-bs-target="#editItemModal{{ $item->id }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('items.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Add Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="video" class="form-label">Video</label>
                        <input type="text" name="video" id="video" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link</label>
                        <input type="text" name="link" id="link" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input type="text" name="file" id="file" class="form-control">
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
                        <label for="cohort_id" class="form-label">Cohort</label>
                        <select name="cohort_id" id="cohort_id" class="form-control" required>
                            <option value="" disabled selected>Select Cohort</option>
                            @foreach($cohorts as $cohort)
                                <option value="{{ $cohort->id }}">{{ $cohort->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="techno_to_cohort_id" class="form-label">Techno to Cohort</label>
                        <select name="techno_to_cohort_id" id="techno_to_cohort_id" class="form-control" required>
                            <option value="" disabled selected>Select Techno</option>
                            @foreach($technoToCohorts as $techno)
                                <option value="{{ $techno->id }}">
                                    {{ $techno->cohort->name }} - {{ $techno->technology->name }}
                                </option>
                            @endforeach
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

<!-- Edit Item Modals -->
@foreach($items as $item)
    <div class="modal fade" id="editItemModal{{ $item->id }}" tabindex="-1" aria-labelledby="editItemModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('items.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editItemModalLabel{{ $item->id }}">Edit Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $item->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control">{{ $item->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="video" class="form-label">Video</label>
                            <input type="text" name="video" id="video" class="form-control" value="{{ $item->video }}">
                        </div>
                        <div class="mb-3">
                            <label for="link" class="form-label">Link</label>
                            <input type="text" name="link" id="link" class="form-control" value="{{ $item->link }}">
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">File</label>
                            <input type="text" name="file" id="file" class="form-control" value="{{ $item->file }}">
                        </div>
                        <div class="mb-3">
                            <label for="techno_to_cohort_id" class="form-label">Techno to Cohort</label>
                            <select name="techno_to_cohort_id" id="techno_to_cohort_id" class="form-control">
                                @foreach($technoToCohorts as $techno)
                                    <option value="{{ $techno->id }}" {{ $techno->id == $item->techno_to_cohort_id ? 'selected' : '' }}>
                                    {{ $techno->cohort->name }} - {{ $techno->technology->name }}
                                    </option>
                                @endforeach
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#itemsTable').DataTable();
    });
</script>

@include('admin.partials.footer')
