<?php
include_once 'LoginClass.php';
include_once '../DB/db.php';

class TaskClass extends LoginClass {
    protected $conn;


    
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
        if (!$this->conn) {
            error_log("Failed to establish database connection in TaskClass");
            throw new Exception("Database connection failed");
        }
    }



    public function getUsername() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['username'] ?? null;
    }
    
    public function createTask($taskData) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['username'])) {
            return "User is not logged in!";
        }
    
        $assignedTo = $_SESSION['username'];
    
        // Process datetime fields
        $due_date = $this->validateDateTime($taskData['due_date']);
        $reminder = $this->validateDateTime($taskData['reminder']);
    
        // Prepare SQL statement
        $sql = "INSERT INTO tasks (title, due_date, reminder, assigned_to, priority, category, flag)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            error_log("SQL Prepare Error: " . $this->conn->error);
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
            return "Task created successfully!";
        } else {
            error_log("SQL Execution Error: " . $stmt->error);
            return "Error creating task. Please try again.";
        }
    }

    private function validateDateTime($value) {
        if (empty($value)) {
            return null;
        }
        $dt = DateTime::createFromFormat('Y-m-d\TH:i', $value);
        if ($dt !== false) {
            return $dt->format('Y-m-d H:i:s');
        }
        return $value;
    }

    private function getLoggedInUser() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['username'] ?? null;
    }

    public function updateTask($taskData) {
        $assignedTo = $this->getLoggedInUser();
        if (!$assignedTo) {
            return "User is not logged in!";
        }

        if (!isset($taskData['id'])) {
            return "Task ID is required!";
        }
    
        $due_date = $this->validateDateTime($taskData['due_date']);
        $reminder = $this->validateDateTime($taskData['reminder']);
    
        $sql = "UPDATE tasks 
                SET title = ?, due_date = ?, reminder = ?, priority = ?, category = ?, flag = ?
                WHERE id = ? AND assigned_to = ?";
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            error_log("SQL Prepare Error in updateTask: " . $this->conn->error);
            return "Database error. Please try again later.";
        }
    
        // Log the values being bound for debugging
        error_log("Updating task with ID: " . $taskData['id'] . " for user: " . $assignedTo);
        error_log("Task data: " . print_r($taskData, true));

        $stmt->bind_param(
            "ssssssis",
            $taskData['title'],
            $due_date,
            $reminder,
            $taskData['priority'],
            $taskData['category'],
            $taskData['flag'],
            $taskData['id'],
            $assignedTo
        );
    
        try {
            $result = $stmt->execute();
            if ($result) {
                if ($stmt->affected_rows > 0) {
                    return true;
                } else {
                    error_log("No rows affected. Task ID: " . $taskData['id'] . ", User: " . $assignedTo);
                    return "No changes made to the task, or task not found.";
                }
            } else {
                error_log("Update execution failed: " . $stmt->error);
                return "Failed to update task.";
            }
        } catch (Exception $e) {
            error_log("Update Task Exception: " . $e->getMessage());
            return "Error updating task. Please try again.";
        } finally {
            $stmt->close();
        }
    }
    
    public function deleteTask($taskId) {
        $assignedTo = $this->getLoggedInUser();
        if (!$assignedTo) {
            return "User is not logged in!";
        }

        $sql = "DELETE FROM tasks WHERE id = ? AND assigned_to = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return "Database error. Please try again later.";
        }

        $stmt->bind_param("is", $taskId, $assignedTo);

        try {
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    return true;
                } else {
                    return "Task not found or you don't have permission to delete it.";
                }
            } else {
                error_log("SQL Execution Error: " . $stmt->error);
                return "Error deleting task.";
            }
        } finally {
            $stmt->close();
        }
    }

    public function getTasksByUser() {
        $username = $this->getLoggedInUser();
        if (!$username) {
            return "User is not logged in!";
        }

        $sql = "SELECT id, title, due_date, reminder, priority, category, flag 
                FROM tasks WHERE assigned_to = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            error_log("SQL Prepare Error in getTasksByUser: " . $this->conn->error);
            return [];
        }

        $stmt->bind_param("s", $username);
        
        try {
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            } else {
                error_log("Error fetching tasks: " . $stmt->error);
                return [];
            }
        } finally {
            $stmt->close();
        }
    }
}