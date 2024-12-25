// Open Add Modal
function openAddModal() {
    document.getElementById('addModal').style.display = 'flex';
}

// Close Add Modal
function closeAddModal() {
    document.getElementById('addModal').style.display = 'none';
    document.getElementById('add-success-message').style.display = 'none';
    document.getElementById('add-error-message').style.display = 'none';
    document.getElementById('add-form').reset(); // Reset the form
}

// Validate Username (with uniqueness check via AJAX)
document.getElementById("add_username").addEventListener("input", function () {
    const username = this.value;
    const nameError = document.getElementById("add-name-error");
    const namePattern = /^[a-zA-Z]{3,15}$/;

    if (namePattern.test(username)) {
        // Check uniqueness
        fetch(`http://localhost/finalproject/Final-1/app/Controllers/check-username.php?username=${username}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    this.style.borderColor = "#ff4d4d";
                    nameError.textContent = "Username already exists.";
                    nameError.style.display = "block";
                } else {
                    this.style.borderColor = "#28a745";
                    nameError.style.display = "none";
                }
            })
            .catch(error => console.error("Error:", error));
    } else {
        this.style.borderColor = "#ddd";
        nameError.textContent = "Username must be 3-15 letters.";
        nameError.style.display = "block";
    }
});

// Validate Email (with uniqueness check via AJAX)
document.getElementById("add_email").addEventListener("input", function () {
    const email = this.value;
    const emailError = document.getElementById("add-email-error");
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailPattern.test(email)) {
        // Check uniqueness
        fetch(`http://localhost/finalproject/Final-1/app/Controllers/check-email.php?email=${email}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    this.style.borderColor = "#ff4d4d";
                    emailError.textContent = "Email already exists.";
                    emailError.style.display = "block";
                } else {
                    this.style.borderColor = "#28a745";
                    emailError.style.display = "none";
                }
            })
            .catch(error => console.error("Error:", error));
    } else {
        this.style.borderColor = "#ddd";
        emailError.textContent = "Enter a valid email address.";
        emailError.style.display = "block";
    }
});

// Validate Password Strength with Tray
const addPasswordInput = document.getElementById('add_password');
const addStrengthTray = document.getElementById('add-strength-tray'); // A tray that pops up for feedback
const addStrengthLevel = document.getElementById('add-strength-level');

addPasswordInput.addEventListener('input', function () {
    const password = addPasswordInput.value;
    const strength = assessStrength(password);

    if (password.length < 8 || strength < 2) {
        addStrengthTray.style.display = 'block';
        addStrengthTray.textContent = 'Weak Password';
        addStrengthTray.style.backgroundColor = '#ff4d4d';
        addStrengthLevel.textContent = 'Weak';
    } else if (strength === 2 || strength === 3) {
        addStrengthTray.style.display = 'block';
        addStrengthTray.textContent = 'Medium Password';
        addStrengthTray.style.backgroundColor = '#ffa500';
        addStrengthLevel.textContent = 'Medium';
    } else if (strength === 4) {
        addStrengthTray.style.display = 'block';
        addStrengthTray.textContent = 'Strong Password';
        addStrengthTray.style.backgroundColor = '#28a745';
        addStrengthLevel.textContent = 'Strong';
    } else {
        addStrengthTray.style.display = 'none';
        addStrengthTray.textContent = '';
    }
});

// Add User Form Submission
document.getElementById('add-form').addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('http://localhost/finalproject/Final-1/app/View/add-user.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'error') {
            document.getElementById('add-error-message').style.display = 'block';
            document.getElementById('add-error-message').textContent = data.message;
            document.getElementById('add-success-message').style.display = 'none';
        } else {
            document.getElementById('add-success-message').style.display = 'block';
            document.getElementById('add-success-message').textContent = data.message;
            document.getElementById('add-error-message').style.display = 'none';
            closeAddModal();
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Helper function to assess password strength
function assessStrength(password) {
    const patterns = [
        /[a-z]/,   // lowercase
        /[A-Z]/,   // uppercase
        /\d/,      // number
        /[!@#$%^&*()+]/  // special character
    ];
    let strength = 0;

    patterns.forEach(pattern => {
        if (pattern.test(password)) strength += 1;
    });

    return strength;
}
