<?php
session_start(); // Start session for user login management

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$dbusername = "root"; // Your MySQL username
$dbpassword = "";     // Your MySQL password
$dbname = "donedeal"; // Database name

// Create connection to the database
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize messages
$message = '';
$messageClass = '';

// Define admin credentials
$admin_username = "admin";
$admin_password = "admin123"; // Change this to a secure password

// Function to sanitize inputs
function sanitizeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Handle Signup
if (isset($_POST['signup'])) {
    $username = sanitizeInput($_POST["signup_username"]);
    $email = sanitizeInput($_POST["signup_email"]);
    $password = sanitizeInput($_POST["signup_password"]);

    // Basic validation
    if (empty($username) || empty($email) || empty($password)) {
        $message = "All fields are required!";
        $messageClass = "error";
    } else {
        // Check if the username already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "Username is already taken!";
            $messageClass = "error";
        } else {
            // Check if the email already exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $message = "Email is already registered!";
                $messageClass = "error";
            } else {
                // Validate password strength
                if (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/', $password)) {
                    $message = "Password must be at least 8 characters long, contain at least one uppercase letter, and one special character.";
                    $messageClass = "error";
                } else {
                    // Hash the password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Insert the user into the database
                    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $username, $email, $hashed_password);

                    if ($stmt->execute()) {
                        $message = "Signup successful! Welcome, " . htmlspecialchars($username) . ".";
                        $messageClass = "success";
                    } else {
                        $message = "Error: " . $stmt->error;
                        $messageClass = "error";
                    }
                }
            }
        }
        $stmt->close();
    }
}

// Handle Login
if (isset($_POST['login'])) {
    $username = sanitizeInput($_POST["login_username"]);
    $password = sanitizeInput($_POST["login_password"]);

    // Basic validation
    if (empty($username) || empty($password)) {
        $message = "All fields are required!";
        $messageClass = "error";
    } else {
        // Check if the user is admin
        if ($username === $admin_username && $password === $admin_password) {
            $_SESSION['username'] = $username; // Store admin username in session
            $message = "Admin Login successful! Welcome, " . htmlspecialchars($username) . ".";
            $messageClass = "success";
            header("Location: dashboard.php"); // Redirect to admin dashboard
            exit();
        } else {
            // Check user credentials
            $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($hashed_password);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    $_SESSION['username'] = $username; // Store username in session
                    $message = "Login successful! Welcome back, " . htmlspecialchars($username) . ".";
                    $messageClass = "success";
                    header("Location: Home.php"); // Redirect to user dashboard
                    exit();
                } else {
                    $message = "Invalid password!";
                    $messageClass = "error";
                }
            } else {
                $message = "Username not found!";
                $messageClass = "error";
            }
            $stmt->close();
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup & Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Basic styling */
        /* Reset some default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-image: url('../../Public/Images/log.png'), url('../../Public/Images/log2.png'); /* Add as many images as needed */
    background-size: 25% auto, 20% auto; /* Set the size of each image */
    background-position: left top, right bottom; /* Position the first image on the left and the second one on the right */
    background-repeat: no-repeat, no-repeat; 
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}
.container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    width: 400px;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    color: #4A90E2;
}

label {
    display: block;
    margin: 15px 0 5px;
    text-align: left;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 5px 0 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #4A90E2;
    outline: none;
}

button {
    background-color: #4A90E2;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #357ABD;
}

.error {
    color: #FF4C4C;
    margin: 10px 0;
}

.success {
    color: #4CAF50;
    margin: 10px 0;
}

        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            z-index: 1;
            opacity: 0;
            transition: all 0.6s ease-in-out;
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: #28a745;
            color: #fff;
            position: absolute;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        form {
            background-color: #fff;
            display: flex;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        form input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        form button {
            padding: 10px 30px;
            border: none;
            background-color: #28a745;
            color: white;
            cursor: pointer;
            margin-top: 20px;
        }
    </style>
</head>
<body>
   
    <div class="container" id="container">
        <!-- Sign Up Form -->
        <div class="form-container sign-up-container">
            <form action="" method="POST">
                <h1 style=" color: green; margin-bottom:10px; font-size:27px;">Welcome to Evernote!</h1>
                
                <p style=" color: black;  margin-bottom:13px; font-size:14px;">Sign up and start taking notes.</p>
                <?php if ($message) : ?>
                    <div class="<?php echo $messageClass; ?>"><?php echo $message; ?></div>
                <?php endif; ?>

                <input type="text" placeholder="Username" name="signup_username" required />
                <input type="email" placeholder="Email" name="signup_email" required />
                <input type="password" placeholder="Password" name="signup_password" required />
                <p style=" color: black;  margin-bottom:13px; font-size:12px;">By creating an account, you are agreeing to our <span style="color:blue;">Terms of Service</span> and acknowledging receipt of our <span style="color:blue;">Privacy Policy,</span></p>
                <button name="signup">Sign Up</button>
            </form>
        </div>

        <!-- Sign In Form -->
        <div class="form-container sign-in-container">
            <form action="" method="POST">
                <h1 style=" color: green;  margin-bottom:13px;">Sign in</h1>
                <p style=" color: black;  margin-bottom:13px; font-size:14px;">to continue to your DoneDeal account.</p>

                <?php if ($message) : ?>
                    <div class="<?php echo $messageClass; ?>"><?php echo $message; ?></div>
                <?php endif; ?>

                <input type="text" placeholder="Username" name="login_username" required />
                <input type="password" placeholder="Password" name="login_password" required />
                <a href="forgot_password.php" style="display: block; margin-top: 10px; color: #4A90E2; text-decoration: none;">Forgot your password?</a>

                <button name="login">Sign In</button>
            </form>
        </div>

         <!-- Overlay Section -->
         <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <br></br>
                    <p>To keep connected with us, please login with your personal info</p>
                    <br></br>

                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <br></br>

                    <p>Enter your personal details and start your journey with us</p>
                    <br></br>

                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
        
    </div>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>
    
</body>
</html>