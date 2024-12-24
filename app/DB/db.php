<?php
$servername = "localhost"; // Host (use the IP address or domain if remote)
$username = "root";        // Your database username
$password = "";            // Your database password
$database = "donedeal"; // Replace with the name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>