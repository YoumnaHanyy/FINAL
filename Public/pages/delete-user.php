<?php
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Enter your MySQL password
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Get data from the AJAX request
$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];

// Check if username is provided
if (empty($username)) {
    echo json_encode(['status' => 'error', 'message' => 'Username is missing']);
    exit;
}

// SQL Delete statement
$sql = "DELETE FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete user']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare SQL statement']);
}

$conn->close();
?>