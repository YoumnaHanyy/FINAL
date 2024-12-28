<?php
// Start the session to access session variables
session_start();

// Include the User class
include('loginClass.php');
include_once('config/db.php');  // Database connection

// Define an empty message variable
$message = '';
$messageClass = '';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        // Registration logic...
    } elseif (isset($_POST['login'])) {
        // Handle user login
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Create an instance of the User class
        $user = new LoginClass();

        // Login the user
        $result = $user->login($username, $password);

        // Set the message based on the result
        if ($result === true) {
            $_SESSION['username'] = $username; // Store the logged-in user's username
            $message = "Login successful!";
            $messageClass = 'success';
        } else {
            $message = $result; // Return error message
            $messageClass = 'error';
        }
    }
}

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // If logged in, send the username in the response
    $response = ['username' => $_SESSION['username']];
} else {
    // If not logged in, send an error message
    $response = ['error' => 'User not logged in'];
}

// Return the response as JSON
echo json_encode($response);
exit;

?>
