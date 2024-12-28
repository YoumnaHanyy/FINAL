<?php

include_once 'LoginClass.php';
// If in the same directory
include_once '../Controllers/taskcontroller.php'; // If the file is one level up

include_once '../DB/db.php';
class TaskClass extends LoginClass {

    public function createTask($taskData) {
        session_start();
        if (!isset($_SESSION['username'])) {
            return "User is not logged in!";
        }
    
        $assignedTo = $_SESSION['username'];
    
        $db = new Database();
        $conn = $db->getConnection();
    
        // Validate title
       
    
        // Process datetime fields
        $due_date = $this->validateDateTime($taskData['due_date']);
        $reminder = $this->validateDateTime($taskData['reminder']);
    
        // Prepare SQL statement
        $sql = "INSERT INTO tasks (title, due_date, reminder, assigned_to, priority, category, flag)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
    
        if (!$stmt) {
            error_log("SQL Prepare Error: " . $conn->error);
            return "Database error. Please try again later.";
        }
    
        $stmt->bind_param(
            "ssssssi",
            $taskData['title'],
            $due_date,
            $reminder,
            $assignedTo,
            $taskData['priority'],
            $taskData['category'],
            $taskData['flag']
        );
    
        if ($stmt->execute()) {
            return "Task created successfully and assigned to $assignedTo!";
        } else {
            error_log("SQL Execution Error: " . $stmt->error);
            return "Error creating task. Please check the input and try again.";
        }
    }
    

    private function validateDateTime($value) {
        $dt = DateTime::createFromFormat('Y-m-d\TH:i', $value); // Adjust for 'datetime-local'
        if ($dt !== false) {
            return $dt->format('Y-m-d H:i:s');
        }
        return $value ?: null;
    }

    private function getLoggedInUser() {
        session_start();
        return $_SESSION['username'] ?? null;
    }

    public function updateTask($taskData) {
        $assignedTo = $this->getLoggedInUser();
        if (!$assignedTo) {
            return "User is not logged in!";
        }
    
        // Validate required fields
        $requiredFields = ['id', 'title', 'due_date', 'reminder', 'priority', 'category', 'flag'];
        foreach ($requiredFields as $field) {
            if (empty($taskData[$field])) {
                return "$field is required for update!";
            }
        }
    
        // Validate datetime fields
        $due_date = $this->validateDateTime($taskData['due_date']);
        $reminder = $this->validateDateTime($taskData['reminder']);
    
        // Prepare SQL statement
        $sql = "UPDATE tasks 
                SET title = ?, due_date = ?, reminder = ?, priority = ?, category = ?, flag = ?
                WHERE id = ? AND assigned_to = ?";
        $stmt = $this->db->prepare($sql);
    
        if (!$stmt) {
            error_log("SQL Prepare Error in updateTask: " . $this->db->error);
            return "Database error. Please try again later.";
        }
    
        $stmt->bind_param(
            "ssssssis", // Parameter types: s = string, i = integer
            $taskData['title'],
            $due_date,
            $reminder,
            $taskData['priority'],
            $taskData['category'],
            $taskData['flag'],
            $taskData['id'],
            $assignedTo
        );
    
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return "Task updated successfully!";
            } else {
                return "No changes made to the task or task not found.";
            }
        } else {
            error_log("SQL Execution Error in updateTask: " . $stmt->error);
            return "Error updating task. Please try again.";
        }
    }

    public function deleteTask($taskId) {
        $assignedTo = $this->getLoggedInUser();
        if (!$assignedTo) {
            return "User is not logged in!";
        }

        $sql = "DELETE FROM tasks WHERE id = ? AND assigned_to = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            error_log("SQL Prepare Error: " . $this->db->error);
            return "Database error. Please try again later.";
        }

        $stmt->bind_param("is", $taskId, $assignedTo);

        if ($stmt->execute()) {
            return "Task deleted successfully!";
        } else {
            error_log("SQL Execution Error: " . $stmt->error);
            return "Error deleting task. Please try again.";
        }
    }



// In your TaskClass or relevant model file
public function getTasksByUser() {
    session_start(); // Start the session to access session variables
    if (!isset($_SESSION['username'])) {
        return "User is not logged in!";
    }

    $db = new Database();
    $conn = $db->getConnection();

    $sql = "SELECT id, title, due_date, reminder, priority, category, flag 
            FROM tasks WHERE assigned_to = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $_SESSION['username']); // Bind the logged-in username
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC); // Fetch all results as an associative array
}
    
}
?>