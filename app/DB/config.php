<?php
$servername = "localhost";
$username = "root";
$password = ""; // Enter your MySQL password here
$dbname = "user_management";

function getConnection() {
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
    }
    return $conn;
}

$conn = new mysqli($servername, $username, $password, $dbname);
$conn = getConnection();


$sql = "
SELECT 
    users.username,
    users.email,
    tasks.id AS task_id,
    tasks.title,
    tasks.due_date,
    tasks.reminder,
    tasks.priority,
    tasks.category,
    tasks.flag,
    tasks.created_at AS task_created_at
FROM 
    users
LEFT JOIN 
    tasks 
ON 
    users.username = tasks.assigned_to
";

$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error fetching data: " . $conn->error);
}

// Initialize an array to hold the data
$usersWithTasks = [];

// Fetch all results
while ($row = $result->fetch_assoc()) {
    $usersWithTasks[] = $row;
}


// Count total users
$totalUsersQuery = "SELECT COUNT(*) AS total_users FROM users";
$totalUsersResult = $conn->query($totalUsersQuery);
$totalUsers = $totalUsersResult->fetch_assoc()["total_users"] ?? 0;

// Count total tasks
$totalTasksQuery = "SELECT COUNT(*) AS total_tasks FROM tasks";
$totalTasksResult = $conn->query($totalTasksQuery);
$totalTasks = $totalTasksResult->fetch_assoc()["total_tasks"] ?? 0;

// Count high-priority tasks
$highPriorityTasksQuery = "SELECT COUNT(*) AS high_priority_tasks FROM tasks WHERE priority = 'High'";
$highPriorityTasksResult = $conn->query($highPriorityTasksQuery);
$highPriorityTasks = $highPriorityTasksResult->fetch_assoc()["high_priority_tasks"] ?? 0;


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data
$sql = "SELECT username, email, password FROM users";
$result = $conn->query($sql);




?>