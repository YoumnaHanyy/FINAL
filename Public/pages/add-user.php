<?php
header('Content-Type: application/json');

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Enter your MySQL password here
$dbname = "user_management";

// Create a new connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

// Retrieve the POST data
$userName = $_POST['username'];
$email = $_POST['email'];
$userPassword = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

// Check if the email already exists in the database
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email already exists
    echo json_encode(["status" => "error", "message" => "A user with this email already exists."]);
} else {
    // Insert the new user into the database
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $userName, $email, $userPassword);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "User added successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
    }
}

// Close the database connection
$stmt->close();
$conn->close();
?>