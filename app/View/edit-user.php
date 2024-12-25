<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Enter your MySQL password
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed']));
}

// Get data from the AJAX request
$old_username = $_POST['old_username'];
$new_username = $_POST['new_username'];
$email = $_POST['email'];
$password = $_POST['password'];

// SQL Update statement
$sql = "UPDATE users SET username=?, email=?, password=? WHERE username=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $new_username, $email, $password, $old_username);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'User updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update user']);
}

$stmt->close();
$conn->close();
?>