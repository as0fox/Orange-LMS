<?php $trainees_active = 'active'; $page = 'Trainees'; ?>
@include('admin.partials.header')

<!-- Add DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Manage Trainees</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTraineeModal">
            <i class="fas fa-plus"></i> 
        </button>
    </div>

    <!-- Success/Errors Alerts -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Trainees Table -->
    <table id="traineesTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Cohort</th>
                <th>Academy</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trainees as $trainee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($trainee->image)
                            <img src="{{ asset('assets/' . $trainee->image) }}" alt="" class="img-thumbnail" style="width: 50px; height: 50px;">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $trainee->name }}</td>
                    <td>{{ $trainee->email }}</td>
                    <td>{{ $trainee->cohort ? $trainee->cohort->name : 'N/A' }}</td>
                    <td>{{ $trainee->academy ? $trainee->academy->name : 'N/A' }}</td>
                    <td>
                        <form action="{{ route('admin.trainees.toggle-active', $trainee->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $trainee->active ? 'btn-success' : 'btn-danger' }}">
                                <i class="{{ $trainee->active ? 'fas fa-check-circle' : 'fas fa-times-circle' }}"></i>
                            </button>
                        </form>
                    </td>
                    <td>
                        <!-- Edit Button -->
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTraineeModal-{{ $trainee->id }}">
                            <i class="fas fa-edit"></i> 
                        </button>

                        <!-- Delete Button
                        <form action="{{ route('admin.trainees.destroy', $trainee->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> 
                            </button>
                        </form> -->
                    </td>
                </tr>

              <!-- Edit Trainee Modal -->
<div class="modal fade" id="editTraineeModal-{{ $trainee->id }}" tabindex="-1" aria-labelledby="editTraineeModalLabel-{{ $trainee->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.trainees.update', $trainee->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editTraineeModalLabel-{{ $trainee->id }}">Edit Trainee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name-{{ $trainee->id }}" class="form-label">Name</label>
                        <input type="text" name="name" id="name-{{ $trainee->id }}" class="form-control" value="{{ old('name', $trainee->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email-{{ $trainee->id }}" class="form-label">Email</label>
                        <input type="email" name="email" id="email-{{ $trainee->id }}" class="form-control" value="{{ old('email', $trainee->email) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="address-{{ $trainee->id }}" class="form-label">Address</label>
                        <input type="text" name="address" id="address-{{ $trainee->id }}" class="form-control" value="{{ old('address', $trainee->address) }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone-{{ $trainee->id }}" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone-{{ $trainee->id }}" class="form-control" value="{{ old('phone', $trainee->phone) }}">
                    </div>
                    <div class="mb-3">
                        <label for="gender-{{ $trainee->id }}" class="form-label">Gender</label>
                        <select name="gender" id="gender-{{ $trainee->id }}" class="form-select">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender', $trainee->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $trainee->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="birthday-{{ $trainee->id }}" class="form-label">Birthday</label>
                        <input type="date" name="birthday" id="birthday-{{ $trainee->id }}" class="form-control" value="{{ old('birthday', $trainee->birthday) }}">
                    </div>
                    <div class="mb-3">
                        <label for="specialization-{{ $trainee->id }}" class="form-label">Specialization</label>
                        <input type="text" name="specialization" id="specialization-{{ $trainee->id }}" class="form-control" value="{{ old('specialization', $trainee->specialization) }}">
                    </div>
                    <div class="mb-3">
                        <label for="academy_id" class="form-label">Academy</label>
                        <select name="academy_id" id="academy_id" class="form-select">
                            <option value="">Select Academy</option>
                            @foreach($academies as $academy)
                                <option value="{{ $academy->id }}" {{ old('academy_id') == $academy->id ? 'selected' : '' }}>
                                    {{ $academy->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cohort_id" class="form-label">Cohort</label>
                        <select name="cohort_id" id="cohort_id" class="form-select">
                            <option value="">Select Cohort</option>
                            @foreach($cohorts as $cohort)
                                <option value="{{ $cohort->id }}" {{ old('cohort_id') == $cohort->id ? 'selected' : '' }}>
                                    {{ $cohort->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
               
                    <div class="mb-3">
                        <label for="image-{{ $trainee->id }}" class="form-label">Upload Image</label>
                        <input type="file" name="image" id="image-{{ $trainee->id }}" class="form-control">
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
        </tbody>
    </table>
</div>


<!-- Add Trainee Modal -->
<div class="modal fade" id="addTraineeModal" tabindex="-1" aria-labelledby="addTraineeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.trainees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addTraineeModalLabel">Add Trainee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select name="gender" id="gender" class="form-select">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="birthday" class="form-label">Birthday</label>
                        <input type="date" name="birthday" id="birthday" class="form-control" value="{{ old('birthday') }}">
                    </div>
                    <div class="mb-3">
                        <label for="specialization" class="form-label">Specialization</label>
                        <input type="text" name="specialization" id="specialization" class="form-control" value="{{ old('specialization') }}">
                    </div>
                
                    <div class="mb-3">
                        <label for="academy_id" class="form-label">Academy</label>
                        <select name="academy_id" id="academy_id" class="form-select">
                            <option value="">Select Academy</option>
                            @foreach($academies as $academy)
                                <option value="{{ $academy->id }}" {{ old('academy_id') == $academy->id ? 'selected' : '' }}>
                                    {{ $academy->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cohort_id" class="form-label">Cohort</label>
                        <select name="cohort_id" id="cohort_id" class="form-select">
                            <option value="">Select Cohort</option>
                            @foreach($cohorts as $cohort)
                                <option value="{{ $cohort->id }}" {{ old('cohort_id') == $cohort->id ? 'selected' : '' }}>
                                    {{ $cohort->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Trainee</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Add DataTables JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    // Initialize DataTable
    $(document).ready(function () {
        $('#traineesTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search trainees..."
            }
        });
    });
</script>

@include('admin.partials.footer')
