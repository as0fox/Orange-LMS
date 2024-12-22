<?php 
$page='Profile';?>
@include('admin.partials.header')

<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-image-wrapper">
            <div class="profile-image-container">
                <img src="{{ asset('assets/' . $user->image) }}" alt="Profile" class="profile-image">
                <div class="profile-image-overlay" data-bs-toggle="modal" data-bs-target="#uploadImageModal">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
        </div>
        
        <div class="profile-info">
            <div class="profile-name-section">
                <h1>{{ $user->name }}</h1>
               
                <div class="settings-icon " data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="fa-solid fa-pen-to-square"></i>
                </div>
            </div>
            
            <div class="profile-stats">
                <div class="stat-item">
                    <span class="stat-label">Academy</span>
                    <span class="stat-text">{{ $user->academy->name }}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Status</span>
                    <span class="stat-text {{ $user->active ? 'text-success' : 'text-danger' }}">
                        {{ $user->active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Type</span>
                    <span class="stat-text">{{ ucfirst($user->type) }}</span>
                </div>
            </div>
            
            <div class="profile-details">
                <div class="detail-item">
                    <i class="fas fa-envelope"></i>
                    <span>{{ $user->email }}</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-calendar"></i>
                    <span>Member since {{ $user->created_at->format('F d, Y') }}</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-clock"></i>
                    <span>Last updated {{ $user->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="info-cards">
        <div class="card info-card">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-user-shield"></i> Account Information</h5>
                <div class="card-content">
                    <div class="info-item">
                        <span class="info-label">ID:</span>
                        <span class="info-value">#{{ $user->id }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Academy:</span>
                        <span class="info-value">{{ $user->academy->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Type:</span>
                        <span class="info-value">{{ ucfirst($user->type) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card info-card">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-shield-alt"></i> Security Settings</h5>
                <div class="card-content">
                    <div class="info-item">
                        <span class="info-label">Status:</span>
                        <span class="info-value {{ $user->active ? 'text-success' : 'text-danger' }}">
                            {{ $user->active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Password:</span>
                        <span class="info-value">•••••••••</span>
                    </div>
                    <button class="btn bg-orange mt-3" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                        <i class="fas fa-key"></i> &nbsp; Change Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #ff7900; border-color: #ff7900;">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload Image Modal -->
<div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadImageModalLabel">Update Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.image.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                        <div class="form-text">Maximum file size: 2MB</div>
                    </div>
                    <div id="imagePreview" class="mt-3 text-center" style="display: none;">
                        <img src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 50%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #ff7900; border-color: #ff7900;">Upload Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.password.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #ff7900; border-color: #ff7900;">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Custom SweetAlert2 styling
const orangeSwalConfig = {
    customClass: {
        popup: 'swal2-orange-theme',
        confirmButton: 'swal2-confirm-button-orange',
        cancelButton: 'swal2-cancel-button-orange',
        title: 'swal2-title-orange',
        closeButton: 'swal2-close-button-orange'
    },
    confirmButtonColor: '#ff7900',
    cancelButtonColor: '#6c757d',
}

// Add custom styles
const style = document.createElement('style');
style.textContent = `
    .swal2-orange-theme {
        border-radius: 15px !important;
        box-shadow: 0 0 20px rgba(255, 121, 0, 0.1) !important;
    }
    .swal2-confirm-button-orange {
        background-color: #ff7900 !important;
        border-color: #ff7900 !important;
        box-shadow: 0 2px 6px rgba(255, 121, 0, 0.3) !important;
    }
    .swal2-confirm-button-orange:hover {
        background-color: #e66d00 !important;
        border-color: #e66d00 !important;
    }
    .swal2-title-orange {
        color: #ff7900 !important;
    }
    .swal2-close-button-orange {
        color: #ff7900 !important;
    }
    .swal2-icon.swal2-success {
        border-color: #ff7900 !important;
        color: #ff7900 !important;
    }
    .swal2-icon.swal2-success [class^='swal2-success-line'] {
        background-color: #ff7900 !important;
    }
    .swal2-icon.swal2-success .swal2-success-ring {
        border-color: rgba(255, 121, 0, 0.3) !important;
    }
    .swal2-timer-progress-bar {
        background-color: #ff7900 !important;
    }
`;
document.head.appendChild(style);

// Error alerts
@if ($errors->any())
    Swal.fire({
        ...orangeSwalConfig,
        title: 'Error',
        html: `@foreach($errors->all() as $error){{ $error }}<br>@endforeach`,
        icon: 'error'
    });
@endif

// Success alerts
@if (session('status'))
    let title = 'Success';
    let message = '';
    
    switch ("{{ session('status') }}") {
        case 'profile-updated':
            message = 'Your profile has been updated successfully.';
            break;
        case 'profile-image-updated':
            message = 'Your profile picture has been updated successfully.';
            break;
        case 'password-updated':
            message = 'Your password has been changed successfully.';
            break;
        default:
            message = "{{ session('status') }}";
    }

    Swal.fire({
        ...orangeSwalConfig,
        title: title,
        text: message,
        icon: 'success',
        timer: 3000,
        timerProgressBar: true,
        showCloseButton: true
    });
@endif

// Confirmation dialogs
document.querySelector('#changePasswordModal form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    
    Swal.fire({
        ...orangeSwalConfig,
        title: 'Confirm Password Change',
        text: 'Are you sure you want to change your password?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, change it!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});

document.querySelector('#editProfileModal form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;

    Swal.fire({
        ...orangeSwalConfig,
        title: 'Confirm Profile Update',
        text: 'Are you sure you want to update your profile information?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
</script>

@include('admin.partials.footer')