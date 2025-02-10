document.getElementById('firstName').addEventListener('input', function () {
    const firstName = this.value.trim();
    const errorDiv = document.getElementById('firstNameError');
    
    
    if (firstName.length === 0) {
        errorDiv.textContent = "Enter Firstname";
    } else {
        for (let i = 0; i < firstName.length; i++) {
            let v = firstName[i];
            if (!(v >= "A" && v <= "Z") && !(v >= "a" && v <= "z")) {
                errorDiv.textContent = "Not allowed special character and space in Firstname";
                return;
            }
        }
        errorDiv.textContent = ''; // No errors
    }
});

document.getElementById('lastName').addEventListener('input', function () {
    const lastName = this.value.trim();
    const errorDiv = document.getElementById('lastNameError');
    
    if (lastName.length !== 0) {
        for (let i = 0; i < lastName.length; i++) {
            let v = lastName[i];
            if (!(v >= "A" && v <= "Z") && !(v >= "a" && v <= "z")) {
                errorDiv.textContent = "Not allowed special character and space in Lastname";
                return;
            }
        }
    }
    errorDiv.textContent = '';
});

document.getElementById('email').addEventListener('input', function () {
    const email = this.value.trim();
    const errorDiv = document.getElementById('emailError');
    const mailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!email.match(mailPattern)) {
        errorDiv.textContent = "Please enter a valid email address";
    } else {
        errorDiv.textContent = '';
    }
});

// Address validation
document.getElementById('address1').addEventListener('input', function () {
    const address1 = this.value.trim();
    const errorDiv = document.getElementById('address1Error');
    
    if (address1 === "") {
        errorDiv.textContent = "Please enter an address";
    } else {
        errorDiv.textContent = '';
    }
});

document.getElementById('address2').addEventListener('input', function () {
    const address2 = this.value.trim();
    const errorDiv = document.getElementById('address2Error');
    
    if (address2 !== "" && address2.length < 3) {
        errorDiv.textContent = "Remove space from address2 and if written, enter at least 3 characters";
    } else {
        errorDiv.textContent = ''; 
    }
});

// Country, State, and City Validation
document.getElementById('countrySel').addEventListener('change', function () {
    const country = this.value;
    const errorDiv = document.getElementById('countryError');

    if (country === "") {
        errorDiv.textContent = "Please select country";
    } else {
        errorDiv.textContent = ''; 
    }
});

document.getElementById('stateDropdown').addEventListener('change', function () {
    const state = this.value;
    const errorDiv = document.getElementById('stateError');

    if (state === "") {
        errorDiv.textContent = "Please select state";
    } else {
        errorDiv.textContent = '';
    }
});

document.getElementById('cityDropdown').addEventListener('change', function () {
    const city = this.value;
    const errorDiv = document.getElementById('cityError');

    if (city === "") {
        errorDiv.textContent = "Please select city";
    } else {
        errorDiv.textContent = ''; 
    }
});


document.getElementById('username').addEventListener('input', function () {
    const username = this.value.trim();
    const errorDiv = document.getElementById('usernameError');
    
    if (username === "") {
        errorDiv.textContent = "Please enter username";
    } else if (username.length < 4 || username.length > 20) {
        errorDiv.textContent = "Username should be between 4 to 20 characters";
    } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
        errorDiv.textContent = "Username can only contain letters, numbers, and underscores";
    } else {
        errorDiv.textContent = '';
    }
});

document.getElementById('password').addEventListener('input', function () {
    const password = this.value.trim();
    const errorDiv = document.getElementById('passwordError');

    if (password.length < 8) {
        errorDiv.textContent = "Password must be at least 8 characters";
    } else {
        errorDiv.textContent = ''; 
    }
    validateConfirmPassword();
});

document.getElementById('conpassword').addEventListener('input', function () {
    const confirmPassword = this.value.trim();
    const errorDiv = document.getElementById('conpasswordError');
    validateConfirmPassword();
});

function validateConfirmPassword() {
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('conpassword').value.trim();
    const errorDiv = document.getElementById('conpasswordError');

    if (confirmPassword.length > 0 && password !== confirmPassword) {
        errorDiv.textContent = "Passwords do not match.";
    } else if (confirmPassword.length > 0 && confirmPassword.length < 8) {
        errorDiv.textContent = "Confirm Password must be at least 8 characters.";
    } else {
        errorDiv.textContent = ''; 
    }
}

document.getElementById('profilePic').addEventListener('change', function () {
    const file = this.files[0];
    const allowedExtensions = ["image/jpeg", "image/png", "image/jpg"];
    const errorDiv = document.getElementById('profilePicError');

    if (!file) {
        errorDiv.textContent = "Please select a profile picture.";
    } else if (file.size > 1024 * 1024) {
        errorDiv.textContent = "File size should not exceed 1 MB.";
    } else if (!allowedExtensions.includes(file.type)) {
        errorDiv.textContent = "Only JPG, JPEG, and PNG files are allowed.";
    } else {
        errorDiv.textContent = ''; 
    }
});

// Form submission validation
document.getElementById('userForm').addEventListener('submit', function (event) {
    // Prevent form submission if any error message exists
    if (document.querySelector('.error:empty') === null) {
        event.preventDefault();
        alert('Please correct the errors in the form.');
    }
});
