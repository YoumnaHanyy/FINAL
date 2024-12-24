<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$servername = "localhost";
$dbusername = "root"; // Your MySQL username
$dbpassword = "";     // Your MySQL password
$dbname = "todo_app"; // Database name

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
$admin_password = "admin123"; // Change this to a more secure password

// Check if form data has been submitted for signup
if (isset($_POST['signup'])) {
    $username = $_POST["signup_username"];
    $email = $_POST["signup_email"];
    $password = $_POST["signup_password"];

    // Basic input validation
    if (empty($username) || empty($email) || empty($password)) {
        $message = "All fields are required!";
        $messageClass = "error";
    } else {
        // Check if the username is taken
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "Username is already taken!";
            $messageClass = "error";
        } else {
            // Check if the email is taken
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $message = "Email is already registered!";
                $messageClass = "error";
            } else {
                // Password validation
                if (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/', $password)) {
                    $message = "Password must be at least 8 characters long, contain at least one uppercase letter, and one special character.";
                    $messageClass = "error";
                } else {
                    // Hash the password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Insert user data into the database
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

// Check if form data has been submitted for login
if (isset($_POST['login'])) {
    $username = $_POST["login_username"];
    $password = $_POST["login_password"];

    // Basic input validation
    if (empty($username) || empty($password)) {
        $message = "All fields are required!";
        $messageClass = "error";
    } else {
        // Check if the username is admin
        if ($username === $admin_username && $password === $admin_password) {
            $message = "Admin Login successful! Welcome, " . htmlspecialchars($username) . ".";
            $messageClass = "success";
            // Redirect to admin dashboard or another page here
        } else {
            // Prepare a statement to check if the user exists
            $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            // If the user exists, verify the password
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($hashed_password);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    $message = "Login successful! Welcome back, " . htmlspecialchars($username) . ".";
                    $messageClass = "success";
                    header("Location: users.php");
    exit(); 
                    // Redirect to user dashboard or another page here
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
   
    
</head>
<body>
    <div class="container" id="container">
        <!-- Sign Up Form -->
        <div class="form-container sign-up-container">
            <form action="" method="POST">
                <h1 style=" color: green;">Create Account</h1>
                
                <?php if ($message) : ?>
                    <div class="<?php echo $messageClass; ?>"><?php echo $message; ?></div>
                <?php endif; ?>

                <input type="text" placeholder="Username" name="signup_username" required />
                <input type="email" placeholder="Email" name="signup_email" required />
                <input type="password" placeholder="Password" name="signup_password" required />
                <button name="signup" class="signup">Sign Up</button>
            </form>
        </div>

        <!-- Sign In Form -->
        <div class="form-container sign-in-container">
            <form action="" method="POST">
                <h1 style=" color: green;">Sign in</h1>

                <?php if ($message) : ?>
                    <div class="<?php echo $messageClass; ?>"><?php echo $message; ?></div>
                <?php endif; ?>

                <input type="text" placeholder="Username" name="login_username" required />
                <input type="password" placeholder="Password" name="login_password" required />
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