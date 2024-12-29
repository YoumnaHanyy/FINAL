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








/*********************** */


document.getElementById("add_username").addEventListener("input", function () {
    const username = this.value;
    const nameError = document.getElementById("add-name-error");
    const namePattern = /^[a-zA-Z]{3,15}$/;

    if (namePattern.test(username)) {
        fetch(`http://localhost/finalproject/Final-1/app/Controllers/check-username.php?username=${username}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    nameError.textContent = "Username already exists.";
                    nameError.style.display = "block";
                } else {
                    nameError.style.display = "none";
                }
            });
    } else {
        nameError.textContent = "Username must be 3-15 letters.";
        nameError.style.display = "block";
    }
});

// Email Validation
document.getElementById("add_email").addEventListener("input", function () {
    const email = this.value;
    const emailError = document.getElementById("add-email-error");
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (emailPattern.test(email)) {
        fetch(`http://localhost/finalproject/Final-1/app/Controllers/check-email.php?email=${email}`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    emailError.textContent = "Email already exists.";
                    emailError.style.display = "block";
                } else {
                    emailError.style.display = "none";
                }
            });
    } else {
        emailError.textContent = "Enter a valid email address.";
        emailError.style.display = "block";
    }
});

// Password Strength Validation
document.getElementById("add_password").addEventListener("input", function () {
    const password = this.value;
    const bar = document.getElementById("add-strength-bar");
    const level = document.getElementById("add-strength-level");
    const tip = document.getElementById("add-strength-tip");
    const strength = assessStrength(password);

    bar.style.width = `${strength * 25}%`;
    if (strength < 2) {
        bar.style.backgroundColor = "#ff4d4d";
        level.textContent = "Weak";
    } else if (strength === 2) {
        bar.style.backgroundColor = "#ffa500";
        level.textContent = "Medium";
    } else {
        bar.style.backgroundColor = "#28a745";
        level.textContent = "Strong";
    }
});

function assessStrength(password) {
    const patterns = [/.*[a-z]/, /.*[A-Z]/, /.*\d/, /.*[!@#$%^&*]/];
    return patterns.reduce((count, regex) => (regex.test(password) ? count + 1 : count), 0);
}

// Form Submission
document.getElementById("add-form").addEventListener("submit", function (event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch("http://localhost/finalproject/Final-1/app/View/add-user.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === "error") {
                document.getElementById("add-error-message").textContent = data.message;
                document.getElementById("add-error-message").style.display = "block";
            } else {
                document.getElementById("add-success-message").textContent = data.message;
                document.getElementById("add-success-message").style.display = "block";
            }
        });
});