@include('admin.partials.header')

<!-- Main Content -->
<main class="main-content">
    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 py-3 shadow-sm">
        <div class="container-fluid">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Technologies Assignment</li>
            </ol>

            <div class="d-flex align-items-center ms-auto">
                <div class="dropdown">
                    <a href="#" class="nav-link" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="nav-link text-black" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="nav-link text-danger" type="submit">{{ __('Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Section -->
    <div class="container mt-4">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Assign Technologies</h2>
        </div>

        <!-- Success/Errors Alerts -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Filters -->
        <form method="GET" action="{{ route('techno_to_cohort.index') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="academy_id">Academy</label>
                    <select name="academy_id" id="academy_id" class="form-control" onchange="this.form.submit()">
                        <option value="">Select Academy</option>
                        @foreach($academies as $academy)
                            <option value="{{ $academy->id }}" {{ request('academy_id') == $academy->id ? 'selected' : '' }}>
                                {{ $academy->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="cohort_id">Cohort</label>
                    <select name="cohort_id" id="cohort_id" class="form-control" onchange="this.form.submit()">
                        <option value="">Select Cohort</option>
                        @foreach($cohorts as $cohort)
                            <option value="{{ $cohort->id }}" {{ request('cohort_id') == $cohort->id ? 'selected' : '' }}>
                                {{ $cohort->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <!-- Technologies Assignment Form -->
        <form method="POST" action="{{ route('techno_to_cohort.store') }}">
            @csrf
            <input type="hidden" name="academy_id" value="{{ request('academy_id') }}">
            <input type="hidden" name="cohort_id" value="{{ request('cohort_id') }}">

            <div class="card">
                <div class="card-header">
                    <h4>Available Technologies</h4>
                </div>
                <div class="card-body">
                    @foreach($technologies as $technology)
                        <div class="form-check">
                            <input type="checkbox" name="technologies[]" value="{{ $technology->id }}" 
                                   class="form-check-input"
                                   @if(request('cohort_id') && $selectedTechnologies->contains($technology->id)) checked @endif>
                            <label class="form-check-label">{{ $technology->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Assign</button>
            </div>
        </form>
    </div>
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
