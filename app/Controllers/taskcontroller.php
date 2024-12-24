<?php
require_once '../DB/db.php';
class TaskController {
    public function createTask($taskData) {
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
            $taskData['assigned_to'],
            $taskData['priority'],
            $taskData['category'],
            $taskData['flag']
        );

        if ($stmt->execute()) {
            return "Task created successfully!";
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







