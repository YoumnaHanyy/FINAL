<?php
require_once '../DB/db.php'; // Database connection

class TaskController {
    public function createTask($taskData) {
        $db = new Database(); // Assuming `db.php` has a Database class
        $conn = $db->getConnection();

        $sql = "INSERT INTO tasks (title, due_date, reminder, assigned_to, priority, category, flag)
                VALUES (:title, :due_date, :reminder, :assigned_to, :priority, :category, :flag)";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':title', $taskData['title']);
        $stmt->bindParam(':due_date', $taskData['due_date']);
        $stmt->bindParam(':reminder', $taskData['reminder']);
        $stmt->bindParam(':assigned_to', $taskData['assigned_to']);
        $stmt->bindParam(':priority', $taskData['priority']);
        $stmt->bindParam(':category', $taskData['category']);
        $stmt->bindParam(':flag', $taskData['flag']);

        if ($stmt->execute()) {
            return "Task created successfully!";
        } else {
            return "Error creating task.";
        }
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskData = json_decode(file_get_contents('php://input'), true);

    $taskController = new TaskController();
    $result = $taskController->createTask($taskData);

    echo json_encode(['message' => $result]);
}
?>


