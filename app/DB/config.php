
<?php
$servername = "localhost";
$username = "root";
$password = ""; // Enter your MySQL password here
$dbname = "donedeal";

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


$sql2 = "
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
    tasks.completed,
    tasks.created_at AS task_created_at
FROM 
    users
LEFT JOIN 
    tasks 
ON 
    users.username = tasks.assigned_to
";

$result2 = $conn->query($sql2);

// Check if the query was successful
if ($result2 === false) {
    die("Error fetching data: " . $conn->error);
}

// Initialize an array to hold the data
$usersWithTasks = [];

// Fetch all results
while ($row = $result2->fetch_assoc()) {
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

// Count total taskss
$totalTasksQuery = "SELECT COUNT(*) AS total_taskss FROM tasks";
$totalTasksResult = $conn->query($totalTasksQuery);
$totalTasks = $totalTasksResult->fetch_assoc()["total_taskss"] ?? 0;

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


$sql1 = "
SELECT 
    users.username,
    COUNT(tasks.id) AS total_taskss,
    SUM(tasks.completed) AS completed

FROM 
    users
LEFT JOIN 
    tasks 
ON 
    users.username = tasks.assigned_to
GROUP BY 
    users.username
";

$result1 = $conn->query($sql1);

// Check if the query was successful
if ($result1 === false) {
    die("Error fetching data: " . $conn->error);
}

// Initialize an array to hold the results
$userTaskCounts = [];

// Fetch all results
while ($row = $result1->fetch_assoc()) {
    $userTaskCounts[] = $row;
}

?>