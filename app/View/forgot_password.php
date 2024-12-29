<?php
session_start();
require_once '../DB/db.php';

$db = new Database();
$conn = $db->getConnection();

function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function validatePassword($password) {
    // Password must be at least 8 characters and contain at least one number
    return strlen($password) >= 8 && preg_match('/[0-9]/', $password);
}

$message = '';
$showPasswordForm = false;
$resetSuccess = false;
$messageType = '';

if (isset($_POST['forgot_password'])) {
    $username = sanitizeInput($_POST['username']);

    if (empty($username)) {
        $message = "Username is required.";
        $messageType = "error";
    } else {
        if ($_POST['captcha'] !== $_POST['captcha_answer']) {
            $message = "CAPTCHA verification failed.";
            $messageType = "error";
        } else {
            // Check if the user exists and is active
            $stmt = $conn->prepare("SELECT id, email FROM users WHERE username = ? AND status = 'active'");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $showPasswordForm = true;
                $userData = $result->fetch_assoc();
                $_SESSION['reset_user_id'] = $userData['id']; // Store user ID in session for security
            } else {
                $message = "User not found or account is inactive.";
                $messageType = "error";
            }

            $stmt->close();
        }
    }
}

if (isset($_POST['reset_password'])) {
    $newPassword = sanitizeInput($_POST['new_password']);
    $confirmPassword = sanitizeInput($_POST['confirm_password']);
    $userId = $_SESSION['reset_user_id'] ?? 0;

    if (empty($newPassword) || empty($confirmPassword)) {
        $message = "All password fields are required.";
        $messageType = "error";
        $showPasswordForm = true;
    } elseif (!validatePassword($newPassword)) {
        $message = "Password must be at least 8 characters and contain at least one number.";
        $messageType = "error";
        $showPasswordForm = true;
    } elseif ($newPassword !== $confirmPassword) {
        $message = "Passwords do not match.";
        $messageType = "error";
        $showPasswordForm = true;
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $updateStmt = $conn->prepare("UPDATE users SET password = ?, password_reset_at = NOW() WHERE id = ?");
        $updateStmt->bind_param("si", $hashedPassword, $userId);

        if ($updateStmt->execute()) {
            $message = "Password reset successful. Redirecting to login...";
            $messageType = "success";
            $resetSuccess = true;
            $showPasswordForm = false;
            unset($_SESSION['reset_user_id']); // Clear the session variable
        } else {
            $message = "Error updating password. Please try again.";
            $messageType = "error";
            $showPasswordForm = true;
        }

        $updateStmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            position: relative;
            overflow: hidden;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 25px;
            font-size: 24px;
            text-align: center;
            font-weight: 600;
        }

        h2 {
            color: #34495e;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: 500;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #95a5a6;
            font-size: 18px;
        }

        input {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            outline: none;
            background: #f8f9fa;
        }

        input:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            background: white;
        }

        input::placeholder {
            color: #95a5a6;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #95a5a6;
        }

        button {
            width: 100%;
            padding: 12px 20px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        button:hover {
            background: #2980b9;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        button:active {
            transform: translateY(1px);
        }

        .message {
            padding: 15px;
            margin: 0 0 20px 0;
            border-radius: 8px;
            font-size: 14px;
            text-align: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .message i {
            margin-right: 10px;
            font-size: 18px;
        }

        .success {
            background-color: #d4f5e2;
            color: #0f5132;
            border: 1px solid #a3e4c9;
        }

        .error {
            background-color: #ffe3e3;
            color: #842029;
            border: 1px solid #ffc9c9;
        }

        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            background: white;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            padding: 30px;
            border-radius: 15px;
            width: 90%;
            max-width: 400px;
        }

        .modal.active {
            display: block;
            animation: modalFadeIn 0.3s ease forwards;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 999;
            display: none;
            backdrop-filter: blur(3px);
        }

        .overlay.active {
            display: block;
            animation: overlayFadeIn 0.3s ease forwards;
        }

        #captchaQuestion {
            font-size: 18px;
            margin-bottom: 15px;
            color: #2c3e50;
            text-align: center;
        }

        .redirect-message {
            display: inline-block;
            margin-left: 5px;
            font-weight: normal;
        }

        .back-to-login {
            text-align: center;
            margin-top: 20px;
        }

        .back-to-login a {
            color: #3498db;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .back-to-login a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        .password-requirements {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
            padding-left: 45px;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -48%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        @keyframes overlayFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 20px;
            }

            h1 {
                font-size: 22px;
            }

            button {
                padding: 10px 16px;
                font-size: 15px;
            }

            .modal {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="logo-container">
            <i class="fas fa-lock fa-3x" style="color: #3498db;"></i>
        </div>
        <h1>Reset Password</h1>
        
        <?php if (!empty($message)) : ?>
            <div class="message <?php echo $messageType; ?>">
                <i class="fas fa-<?php echo $messageType === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                <?php echo $message; ?>
                <?php if ($resetSuccess) : ?>
                    <span class="redirect-message">(<span id="countdown">3</span>)</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (!$showPasswordForm && !$resetSuccess) : ?>
            <form method="POST" action="" id="forgotPasswordForm">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Enter your username" required>
                </div>
                <input type="hidden" name="forgot_password" value="1">
                <input type="hidden" name="captcha_answer" id="captchaAnswer" value="">
                <input type="hidden" name="captcha" id="captchaInput" value="">
                <button type="button" id="resetPassword">Reset Password</button>
            </form>
        <?php elseif ($showPasswordForm) : ?>
            <form method="POST" action="">
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="new_password" id="newPassword" placeholder="Enter your new password" required>
                    <i class="fas fa-eye password-toggle" onclick="togglePassword('newPassword')"></i>
                    <div class="password-requirements">
                        Password must be at least 8 characters and contain at least one number
                    </div>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm your new password" required>
                    <i class="fas fa-eye password-toggle" onclick="togglePassword('confirmPassword')"></i>
                </div>
                <button type="submit" name="reset_password">Update Password</button>
            </form>
        <?php endif; ?>

        <div class="back-to-login">
            <a href="../View/login.php">Back to Login</a>
        </div>
    </div>

    <!-- Modal -->
    <div class="overlay" id="overlay"></div>
    <div class="modal" id="captchaModal">
        <h2>Verify CAPTCHA</h2>
        <p id="captchaQuestion"></p>
        <div class="input-group">
            <i class="fas fa-calculator"></i>
            <input type="text" id="captchaResponse" placeholder="Enter your answer">
        </div>
        <button id="verifyCaptcha">Verify</button>
    </div>

    <script>
        const resetPasswordButton = document.getElementById('resetPassword');
        const captchaModal = document.getElementById('captchaModal');
        const overlay = document.getElementById('overlay');
        const captchaQuestion = document.getElementById('captchaQuestion');
        const captchaResponse = document.getElementById('captchaResponse');
        const captchaInput = document.getElementById('captchaInput');
        const captchaAnswer = document.getElementById('captchaAnswer');
        const forgotPasswordForm = document.getElementById('forgotPasswordForm');

        // Generate CAPTCHA
        const num1 = Math.floor(Math.random() * 10) + 1;
        const num2 = Math.floor(Math.random() * 10) + 1;
        const answer = num1 + num2;

        captchaQuestion.innerText = `What is ${num1} + ${num2}?`;
        captchaAnswer.value = answer;

        resetPasswordButton?.addEventListener('click', () => {
            captchaModal.classList.add('active');
            overlay.classList.add('active');
        });

        document.getElementById('verifyCaptcha')?.addEventListener('click', () => {
            const userAnswer = parseInt(captchaResponse.value);
            if (userAnswer === answer) {
                captchaInput.value = answer;
                captchaModal.classList.remove('active');
                overlay.classList.remove('active');
                forgotPasswordForm.submit();
            } else {
                alert('CAPTCHA verification failed. Please try again.');
                captchaResponse.value = '';
            }
        });

        function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling;
    
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

// Handle Enter key in CAPTCHA modal
captchaResponse?.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        e.preventDefault();
        document.getElementById('verifyCaptcha').click();
    }
});

// Close modal when clicking outside
overlay?.addEventListener('click', () => {
    captchaModal.classList.remove('active');
    overlay.classList.remove('active');
});

// Password validation
const newPasswordInput = document.getElementById('newPassword');
const confirmPasswordInput = document.getElementById('confirmPassword');

function validatePasswordMatch() {
    if (confirmPasswordInput && newPasswordInput) {
        if (confirmPasswordInput.value !== newPasswordInput.value) {
            confirmPasswordInput.setCustomValidity("Passwords don't match");
        } else {
            confirmPasswordInput.setCustomValidity('');
        }
    }
}

if (newPasswordInput && confirmPasswordInput) {
    newPasswordInput.addEventListener('change', validatePasswordMatch);
    confirmPasswordInput.addEventListener('keyup', validatePasswordMatch);
}

// Password strength validation
function validatePasswordStrength(password) {
    const minLength = 8;
    const hasNumber = /\d/.test(password);
    return password.length >= minLength && hasNumber;
}

if (newPasswordInput) {
    newPasswordInput.addEventListener('input', function() {
        if (!validatePasswordStrength(this.value)) {
            this.setCustomValidity('Password must be at least 8 characters and contain at least one number');
        } else {
            this.setCustomValidity('');
        }
    });
}

// Redirect functionality after successful password reset
<?php if ($resetSuccess) : ?>
const countdownElement = document.getElementById('countdown');
let seconds = 3;

const countdown = setInterval(() => {
    seconds--;
    if (countdownElement) {
        countdownElement.textContent = seconds;
    }
    
    if (seconds <= 0) {
        clearInterval(countdown);
        window.location.href = '../View/login.php';
    }
}, 1000);
<?php endif; ?>

// Prevent form resubmission on page refresh
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

// Add loading state to buttons
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function() {
        const button = this.querySelector('button[type="submit"]');
        if (button) {
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        }
    });
});

// Custom error handling for failed requests
window.addEventListener('error', function(e) {
    console.error('An error occurred:', e.error);
    alert('An error occurred. Please try again later.');
    location.reload();
});
</script>
</body>
</html>