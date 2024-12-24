<?php
// Include the User class
include('loginClass.php');
include_once('config/db.php');  // Database connection
include_once('views/login.php');  // View file to render the page

// Define an empty message variable
$message = '';
$messageClass = '';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        // Handle user registration
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Create an instance of the User class
        $user = new User();

        // Register the user
        $result = $user->register($username, $email, $password);
        
        // Set the message based on the result
        if ($result === true) {
            $message = "Registration successful!";
            $messageClass = 'success';
        } else {
            $message = $result; // Return error message
            $messageClass = 'error';
        }
    } elseif (isset($_POST['login'])) {
        // Handle user login
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Create an instance of the User class
        $user = new User();

        // Login the user
        $result = $user->login($username, $password);
        
        // Set the message based on the result
        if ($result === true) {
            $message = "Login successful!";
            $messageClass = 'success';
        } else {
            $message = $result; // Return error message
            $messageClass = 'error';
        }
    }
}

// Include the view to show the result
include('view.php');
?>