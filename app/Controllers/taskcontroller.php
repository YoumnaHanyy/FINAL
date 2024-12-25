<?php
require_once '../DB/db.php';


session_start(); // Start the session

class TaskController {
    public function createTask($taskData) {
        session_start(); // Start the session to access session variables
        if (!isset($_SESSION['username'])) {
            return "User is not logged in!";
        }

        $assignedTo = $_SESSION['username']; // Get the logged-in username

        require_once '../DB/db.php';
        $db = new Database();
        $conn = $db->getConnection();

        // Process datetime fields
        $due_date = $this->validateDateTime($taskData['due_date']);
        $reminder = $this->validateDateTime($taskData['reminder']);

        $sql = "INSERT INTO tasks (title, due_date, reminder, assigned_to, priority, category, flag)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ssssssi",
            $taskData['title'],
            $due_date,
            $reminder,
            $assignedTo, // Assign task to the logged-in user
            $taskData['priority'],
            $taskData['category'],
            $taskData['flag']
        );

        if ($stmt->execute()) {
            return "Task created successfully and assigned to $assignedTo!";
        } else {
            error_log("SQL Error: " . $stmt->error);
            return "Error creating task: " . $stmt->error;
        }
    }

    private function validateDateTime($value) {
        $dt = DateTime::createFromFormat('Y-m-d\TH:i', $value); // Adjust for 'datetime-local'
        if ($dt !== false) {
            return $dt->format('Y-m-d H:i:s');
        }
        return $value ?: null;
    }



    public function updateTask($taskData) {
        session_start(); // Start the session to access session variables
        if (!isset($_SESSION['username'])) {
            return "User is not logged in!";
        }
    
        $assignedTo = $_SESSION['username']; // Get the logged-in username
    
        require_once '../DB/db.php';
        $db = new Database();
        $conn = $db->getConnection();
    
        // Process datetime fields
        $due_date = $this->validateDateTime($taskData['dueDate']);
        $reminder = $this->validateDateTime($taskData['reminder']);
    
        // Prepare the SQL UPDATE query
        $sql = "UPDATE tasks SET title = ?, due_date = ?, reminder = ?, assigned_to = ?, priority = ?, category = ?, flag = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
    
        $stmt->bind_param(
            "sssssssi", 
            $taskData['description'],
            $due_date,
            $reminder,
            $assignedTo, 
            $taskData['priority'],
            $taskData['category'],
            $taskData['flag'],
            $taskData['id'] // The id from the task data to target the correct task
        );
    
        if ($stmt->execute()) {
            return "Task updated successfully!";
        } else {
            error_log("SQL Error: " . $stmt->error);
            return "Error updating task: " . $stmt->error;
        }
    }
    


    public function deleteTask($taskIndex) {
        session_start();
        if (!isset($_SESSION['username'])) {
            return ['success' => false, 'message' => 'User is not logged in!'];
        }
    
        $db = new Database();
        $conn = $db->getConnection();
    
        // Check if task exists
        $checkSql = "SELECT * FROM tasks WHERE id = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("i", $taskIndex);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
    
        if ($result->num_rows === 0) {
            return ['success' => false, 'message' => 'Task not found in the database.'];
        }
    
        // If task exists, delete it
        $sql = "DELETE FROM tasks WHERE id = ?";
        $stmt = $conn->prepare($sql);
    
        if ($stmt === false) {
            return ['success' => false, 'message' => 'Error preparing statement.'];
        }
    
        $stmt->bind_param("i", $taskIndex);
    
        if ($stmt->execute()) {
            return ['success' => true, 'message' => 'Task deleted successfully!'];
        } else {
            return ['success' => false, 'message' => 'Error deleting task: ' . $stmt->error];
        }
    }
    
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskData = json_decode(file_get_contents('php://input'), true);

    // Debugging: Log received values
    error_log("Received Due Date: " . $taskData['due_date']);
    error_log("Received Reminder: " . $taskData['reminder']);

    if (empty($taskData)) {
        echo json_encode(['success' => false, 'message' => 'No data received.']);
        exit;
    }

    $taskController = new TaskController();
    $result = $taskController->createTask($taskData);

    echo json_encode(['success' => true, 'message' => $result]);
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the action and task data from the incoming request
    $data = json_decode(file_get_contents('php://input'), true);
    $taskController = new TaskController();

    if ($data['action'] === 'update') {
        $result = $taskController->updateTask($data['taskIndex'], $data['taskData']);
    } elseif ($data['action'] === 'delete') {
        $result = $taskController->deleteTask($data['taskIndex']);
    }

    // Return the result as JSON
    echo json_encode($result);
    exit;
}






