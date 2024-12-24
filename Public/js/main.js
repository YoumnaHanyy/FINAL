
document.getElementById("username").addEventListener("input", function () {
    const username = this.value;
    const nameError = document.getElementById("name-error");
    const namePattern = /^[a-zA-Z]{3,15}$/;

    if (namePattern.test(username)) {
        this.style.borderColor = "#28a745";
        nameError.style.display = "none";
    } else {
        this.style.borderColor = "#ddd";
        nameError.style.display = "block";
    }
});

        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strength-bar');
        const strengthLevel = document.getElementById('strength-level');
        // Password strength assessment
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

        // Display strength feedback
        passwordInput.addEventListener('input', function() {
            const password = passwordInput.value;
            const strength = assessStrength(password);

            if (password.length < 8 || strength < 2) {
                strengthBar.className = 'strength-bar weak';
                strengthBar.style.width = '33%';
                strengthLevel.textContent = 'Weak';
                strengthLevel.style.color = '#ff4d4d';
            } else if (strength === 2 || strength === 3) {
                strengthBar.className = 'strength-bar medium';
                strengthBar.style.width = '66%';
                strengthLevel.textContent = 'Medium';
                strengthLevel.style.color = '#ffa500';
            } else if (strength === 4) {
                strengthBar.className = 'strength-bar strong';
                strengthBar.style.width = '100%';
                strengthLevel.textContent = 'Strong';
                strengthLevel.style.color = '#28a745';
            } else {
                strengthBar.className = 'strength-bar';
                strengthBar.style.width = '0';
                strengthLevel.textContent = 'Password strength';
            }
        });


        document.getElementById('user-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const password = document.getElementById('password').value;
            const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()+]).{8,}$/;

            if (!passwordPattern.test(password)) {
                alert("Password must include uppercase, lowercase, a number, a symbol, and be at least 8 characters long.");
                return;
            }

            const formData = new FormData(this);
            const formProps = Object.fromEntries(formData);

            fetch('../php/add-user.php', {
                method: 'POST',
                body: new URLSearchParams(formProps)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    document.getElementById('error-message').style.display = 'block';
                    document.getElementById('error-message').textContent = data.message;
                    document.getElementById('success-message').style.display = 'none';
                } else {
                    document.getElementById('success-message').style.display = 'block';
                    document.getElementById('success-message').textContent = data.message;
                    document.getElementById('error-message').style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
