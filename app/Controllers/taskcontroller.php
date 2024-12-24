<?php
require_once '../DB/db.php';

class TaskController {
    public function createTask($taskData) {
        $db = new Database();
        $conn = $db->getConnection();

        $sql = "INSERT INTO tasks (title, due_date, reminder, assigned_to, priority, category, flag)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param(
            "ssssssi",
            $taskData['title'],
            $taskData['due_date'],
            $taskData['reminder'],
            $taskData['assigned_to'],
            $taskData['priority'],
            $taskData['category'],
            $taskData['flag']
        );

        if ($stmt->execute()) {
            return "Task created successfully!";
        } else {
            return "Error creating task: " . $stmt->error;
        }
    }
}




