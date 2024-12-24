<?php
include 'db.php';

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
                        header('Location: user_dashboard.php');  // Redirect to another page

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