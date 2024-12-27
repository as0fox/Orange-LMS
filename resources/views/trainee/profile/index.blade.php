<?php 
$page='Profile';?>
@include('trainee.partials.header')

<style>
.profile-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.profile-header {
    display: flex;
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
}

.profile-image-wrapper {
    margin-right: 2rem;
}

.profile-image-container {
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    overflow: hidden;
}

.profile-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.5);
    padding: 0.5rem;
    text-align: center;
    cursor: pointer;
    transition: 0.3s;
}

.profile-image-overlay i {
    color: white;
}

.profile-info {
    flex: 1;
}

.profile-name-section {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.profile-name-section h1 {
    margin: 0;
    margin-right: 1rem;
    font-size: 2rem;
}

.settings-icon {
    padding: 0.5rem;
    border-radius: 50%;
    cursor: pointer;
    transition: 0.3s;
}

.settings-icon:hover {
    background: #e6e6e6;
}

.profile-stats {
    display: flex;
    gap: 2rem;
    margin-bottom: 1.5rem;
}

.stat-item {
    display: flex;
    flex-direction: column;
}

.stat-label {
    font-size: 0.875rem;
    color: #666;
}

.stat-text {
    font-weight: 600;
}

.profile-details {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.detail-item i {
    color: #666;
}

.info-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.info-card {
    border-radius: 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.card-title {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.75rem;
}

.info-label {
    color: #666;
}

.info-value {
    font-weight: 500;
}

.modal-content {
    border-radius: 15px;
}

.btn-primary {
    background-color: #ff7900;
    border-color: #ff7900;
}

.btn-primary:hover {
    background-color: #e66d00;
    border-color: #e66d00;
}
.modal-backdrop{
    position: relative !important;
}
.form-label ,.modal-title  {
    color:black !important;
}
</style>

<div class="profile-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-image-wrapper">
            <div class="profile-image-container">
                <img src="{{ asset('assets/' . ($user->image ?? 'default-avatar.png')) }}" alt="Profile" class="profile-image">
                <div class="profile-image-overlay" data-bs-toggle="modal" data-bs-target="#uploadImageModal">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
        </div>
        
        <div class="profile-info">
            <div class="profile-name-section">
                <h1>{{ $user->name }}</h1>
                <div class="settings-icon bg-primary text-black" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
            </div>
            
            <div class="profile-stats">
                <div class="stat-item">
                    <span class="stat-label">Academy</span>
                    <span class="stat-text">{{ $user->academy->name }}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Cohort</span>
                    <span class="stat-text">{{ $user->cohort->name }}</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Status</span>
                    <span class="stat-text {{ $user->active ? 'text-success' : 'text-danger' }}">
                        {{ $user->active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
            
            <div class="profile-details">
                <div class="detail-item">
                    <i class="fas fa-envelope"></i>
                    <span>{{ $user->email }}</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-phone"></i>
                    <span>{{ $user->phone ?? 'Not provided' }}</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-user"></i>
                    <span>{{ ucfirst($user->gender) ?? 'Not specified' }}</span>
                </div>
                <div class="detail-item">
                    <i class="fas fa-calendar"></i>
                    <span>{{ $user->birthday ? date('F d, Y', strtotime($user->birthday)) : 'Not specified' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="info-cards">
        <div class="card info-card">
            <div class="card-body bg-white text-black">
                <h5 class="card-title"><i class="fas fa-user-shield"></i> Personal Information</h5>
                <div class="card-content">
                    <div class="info-item">
                        <span class="info-label">Full Name:</span>
                        <span class="info-value">{{ $user->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $user->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Phone:</span>
                        <span class="info-value">{{ $user->phone ?? 'Not provided' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Address:</span>
                        <span class="info-value">{{ $user->address ?? 'Not provided' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Specialization:</span>
                        <span class="info-value">{{ $user->specialization ?? 'Not specified' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card info-card text-black">
            <div class="card-body bg-white">
                <h5 class="card-title"><i class="fas fa-shield-alt"></i> Account Information</h5>
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
                        <span class="info-label">Cohort:</span>
                        <span class="info-value">{{ $user->cohort->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Type:</span>
                        <span class="info-value">{{ ucfirst($user->type) }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status:</span>
                        <span class="info-value {{ $user->active ? 'text-success' : 'text-danger' }}">
                            {{ $user->active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Member Since:</span>
                        <span class="info-value">{{ $user->created_at->format('F d, Y') }}</span>
                    </div>
                    <button class="btn bg-primary mt-3 text-white" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                        <i class="fas fa-key"></i> &nbsp; Change Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('studentprofile.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
       
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="birthday" class="form-label">Birthday</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $user->birthday }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="specialization" class="form-label">Specialization</label>
                            <input type="text" class="form-control" id="specialization" name="specialization" value="{{ $user->specialization }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="2">{{ $user->address }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary text-white">Save Changes</button>
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
            <form action="{{ route('studentprofile.image.update') }}" method="POST" enctype="multipart/form-data">
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
                    <button type="submit" class="btn btn-primary text-white">Upload Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('studentprofile.password.update') }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label for="current_password" class="form-label text-muted fw-semibold">Current Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control border-end-0" id="current_password" name="current_password" required>
                            <span class="input-group-text bg-white border-start-0 pointer" onclick="togglePassword('current_password')">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label text-muted fw-semibold">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control border-end-0" id="password" name="password" 
                                pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}" 
                                oninput="checkPassword(this.value)"
                                required>
                            <span class="input-group-text bg-white border-start-0 pointer" onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        
                        <!-- Password Strength Indicators -->
                        <div class="mt-3">
                            <div class="d-flex justify-content-between small text-muted mb-1">
                                <span>Password Strength:</span>
                                <span id="strengthText">Too Weak</span>
                            </div>
                            <div class="progress" style="height: 5px;">
                                <div id="strengthBar" class="progress-bar" role="progressbar" style="width: 0%"></div>
                            </div>
                            <div class="mt-3 requirements">
                                <p class="mb-1 small" id="length">✗ At least 8 characters</p>
                                <p class="mb-1 small" id="uppercase">✗ At least one uppercase letter</p>
                                <p class="mb-1 small" id="lowercase">✗ At least one lowercase letter</p>
                                <p class="mb-1 small" id="number">✗ At least one number</p>
                                <p class="mb-1 small" id="special">✗ At least one special character</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label text-muted fw-semibold">Confirm New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control border-end-0" id="password_confirmation" 
                                name="password_confirmation" oninput="checkMatch(this.value)" required>
                            <span class="input-group-text bg-white border-start-0 pointer" onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div id="matchMessage" class="small mt-1"></div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4" id="submitBtn" disabled>Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-light{
        background-color:rgb(255, 255, 255) !important;
    }
.pointer { cursor: pointer; }
.requirements p.valid { color: #198754; }
.requirements p.valid::before { content: "✓ "; }
.requirements p.invalid { color: #dc3545; }
.requirements p.invalid::before { content: "✗ "; }
#strengthBar.bg-danger { background-color: #dc3545 !important; }
#strengthBar.bg-warning { background-color: #ffc107 !important; }
#strengthBar.bg-success { background-color: #198754 !important; }
</style>

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function checkPassword(password) {
    const length = password.length >= 8;
    const uppercase = /[A-Z]/.test(password);
    const lowercase = /[a-z]/.test(password);
    const number = /\d/.test(password);
    const special = /[\W_]/.test(password);
    
    document.getElementById('length').className = `mb-1 small ${length ? 'valid' : 'invalid'}`;
    document.getElementById('uppercase').className = `mb-1 small ${uppercase ? 'valid' : 'invalid'}`;
    document.getElementById('lowercase').className = `mb-1 small ${lowercase ? 'valid' : 'invalid'}`;
    document.getElementById('number').className = `mb-1 small ${number ? 'valid' : 'invalid'}`;
    document.getElementById('special').className = `mb-1 small ${special ? 'valid' : 'invalid'}`;
    
    const strength = [length, uppercase, lowercase, number, special].filter(Boolean).length;
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');
    
    switch(strength) {
        case 0:
        case 1:
            strengthBar.style.width = '20%';
            strengthBar.className = 'progress-bar bg-danger';
            strengthText.textContent = 'Too Weak';
            break;
        case 2:
            strengthBar.style.width = '40%';
            strengthBar.className = 'progress-bar bg-danger';
            strengthText.textContent = 'Weak';
            break;
        case 3:
            strengthBar.style.width = '60%';
            strengthBar.className = 'progress-bar bg-warning';
            strengthText.textContent = 'Medium';
            break;
        case 4:
            strengthBar.style.width = '80%';
            strengthBar.className = 'progress-bar bg-success';
            strengthText.textContent = 'Strong';
            break;
        case 5:
            strengthBar.style.width = '100%';
            strengthBar.className = 'progress-bar bg-success';
            strengthText.textContent = 'Very Strong';
            break;
    }
    
    checkMatch(document.getElementById('password_confirmation').value);
}

function checkMatch(confirmPassword) {
    const password = document.getElementById('password').value;
    const matchMessage = document.getElementById('matchMessage');
    const submitBtn = document.getElementById('submitBtn');
    
    if (confirmPassword === '') {
        matchMessage.textContent = '';
        matchMessage.className = 'small mt-1';
        submitBtn.disabled = true;
        return;
    }
    
    if (password === confirmPassword) {
        matchMessage.textContent = 'Passwords match!';
        matchMessage.className = 'small mt-1 text-success';
        submitBtn.disabled = false;
    } else {
        matchMessage.textContent = 'Passwords do not match';
        matchMessage.className = 'small mt-1 text-danger';
        submitBtn.disabled = true;
    }
}
</script>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('active');
}
// Image preview functionality
document.getElementById('image').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    const previewImg = preview.querySelector('img');
    const file = e.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});

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

// Form submission confirmations
const forms = {
    'editProfileModal': {
        title: 'Confirm Profile Update',
        text: 'Are you sure you want to update your profile information?',
        icon: 'question'
    },
    'changePasswordModal': {
        title: 'Confirm Password Change',
        text: 'Are you sure you want to change your password?',
        icon: 'warning'
    }
};

Object.entries(forms).forEach(([modalId, config]) => {
    document.querySelector(`#${modalId} form`)?.addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        
        Swal.fire({
            ...orangeSwalConfig,
            title: config.title,
            text: config.text,
            icon: config.icon,
            showCancelButton: true,
            confirmButtonText: 'Yes, proceed!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});


</script>

@include('trainee.partials.footer')