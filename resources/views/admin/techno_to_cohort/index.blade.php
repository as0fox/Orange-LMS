<?php $technologiesToCohort_active="active";
$page='Assign Technologies'; ?>
@include('admin.partials.header')



    <!-- Main Content Section -->
    <div class="container mt-5">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-black fw-bold">Assign Technologies</h2>
          
        </div>

        <!-- Success/Errors Alerts -->
        @if (session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
        @endif

        <!-- Filters -->
        <form method="GET" action="{{ route('techno_to_cohort.index') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="academy_id" class="form-label fw-semibold">Academy</label>
                    <select name="academy_id" id="academy_id" class="form-select shadow-sm" onchange="this.form.submit()">
                        <option value="">Select Academy</option>
                        @foreach($academies as $academy)
                            <option value="{{ $academy->id }}" {{ request('academy_id') == $academy->id ? 'selected' : '' }}>
                                {{ $academy->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="cohort_id" class="form-label fw-semibold">Cohort</label>
                    <select name="cohort_id" id="cohort_id" class="form-select shadow-sm" onchange="this.form.submit()">
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

            <div class="card shadow-sm border-2">
                <div class="card-header bg-white text-black">
                    <h4 class="mb-0 fw-bold">Available Technologies</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        @foreach($technologies as $technology)
                            <div class="col-md-6">
                                <div class="form-check mb-2">
                                    <input type="checkbox" name="technologies[]" value="{{ $technology->id }}" 
                                           class="form-check-input shadow-sm"
                                           @if(request('cohort_id') && $selectedTechnologies->contains($technology->id)) checked @endif>
                                    <label class="form-check-label fw-semibold text-secondary">
                                        {{ $technology->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">Assign</button>
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
