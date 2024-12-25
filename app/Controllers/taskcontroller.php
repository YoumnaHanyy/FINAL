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







