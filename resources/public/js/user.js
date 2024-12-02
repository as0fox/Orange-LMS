
function togglePassword() {
    var passwordInput = document.getElementById("password");
    var toggleIcon = document.getElementById("togglePassword");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}

function toggleConfirmPassword() {
    var confirmPasswordInput = document.getElementById("confirm_password");
    var toggleIcon = document.getElementById("toggleConfirmPassword");
    if (confirmPasswordInput.type === "password") {
        confirmPasswordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        confirmPasswordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}

document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const checklist = document.querySelector('.password-checklist');
    const form = document.querySelector('.form-container form');
    
    checklist.style.display = 'block'; // Show checklist on input
    form.style.height = '700px'; 
    form.style.height = '700px';

    const lengthCheck = document.getElementById('length-check');
    const numberCheck = document.getElementById('number-check');
    const lowercaseCheck = document.getElementById('lowercase-check');
    const uppercaseCheck = document.getElementById('uppercase-check');
    const specialCheck = document.getElementById('special-check');

    // Check password length
    lengthCheck.classList.toggle('valid', password.length >= 8);
    lengthCheck.classList.toggle('invalid', password.length < 8);

    // Check for at least 1 number
    numberCheck.classList.toggle('valid', /[0-9]/.test(password));
    numberCheck.classList.toggle('invalid', !/[0-9]/.test(password));

    // Check for at least 1 lowercase letter
    lowercaseCheck.classList.toggle('valid', /[a-z]/.test(password));
    lowercaseCheck.classList.toggle('invalid', !/[a-z]/.test(password));

    // Check for at least 1 uppercase letter
    uppercaseCheck.classList.toggle('valid', /[A-Z]/.test(password));
    uppercaseCheck.classList.toggle('invalid', !/[A-Z]/.test(password));

    // Check for at least 1 special character
    specialCheck.classList.toggle('valid', /[!@#$%^&*(),.?":{}|<>]/.test(password));
    specialCheck.classList.toggle('invalid', !/[!@#$%^&*(),.?":{}|<>]/.test(password));
});

// Hide checklist when the password input loses focus
document.getElementById('password').addEventListener('blur', function() {
    const checklist = document.querySelector('.password-checklist');
    const form = document.querySelector('.form-container form');
    
    
    setTimeout(() => {
        checklist.style.display = 'none'; // Hide checklist after a small delay
        form.style.height = '600px'; // Reset form height when checklist is hidden
       
    }, 100);
});

// Hide checklist when clicking outside of the password input and checklist
document.addEventListener("click", function(event) {
    const passwordInput = document.getElementById("password");
    const checklist = document.querySelector('.password-checklist');
    const form = document.querySelector('.form-container form');
   
    
    if (!passwordInput.contains(event.target) && !checklist.contains(event.target)) {
        checklist.style.display = 'none'; // Hide checklist if click is outside
        form.style.height = '600px'; // Reset form height when checklist is hidden
       
    }
});

function toggleDropdown() {
    const dropdown = document.getElementById("profileDropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

// Close dropdown if clicking outside
window.onclick = function(event) {
    if (!event.target.closest(".profile-container")) {
        document.getElementById("profileDropdown").style.display = "none";
    }
};



    function setRating(value) {
        // Set the hidden input value to the selected rating
        document.getElementById('rating').value = value;
        
        // Change the star icon colors based on selected rating
        const stars = document.querySelectorAll('.star-icon');
        stars.forEach((star, index) => {
            star.name = index < value ? 'star-sharp' : 'star-outline';
            star.style.color = index < value ? 'gold' : 'gray';
        });
    }

