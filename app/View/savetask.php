<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "donedeal";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Connection failed: " . $conn->connect_error]));
}

// Get JSON input
$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (!isset($data['task']) || empty(trim($data['task']))) {
    echo json_encode(["success" => false, "error" => "Task cannot be empty"]);
    exit;
}

$task = $conn->real_escape_string($data['task']);

// Insert the task into the database
$sql = "INSERT INTO tasks (task) VALUES ('$task')";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Error: " . $sql . " " . $conn->error]);
}

$conn->close();
?>
