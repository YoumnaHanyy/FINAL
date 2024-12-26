<?php

include_once 'LoginClass.php';
include_once 'taskcontroller.php';
include_once '../DB/db.php';
class TaskClass extends LoginClass {

    public function createTask($taskData) {
        session_start(); // Start the session to access session variables
        if (!isset($_SESSION['username'])) {
            return "User is not logged in!";
        }

        $assignedTo = $_SESSION['username']; // Get the logged-in username

        
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
        // Check if the user is logged in
        if (!isset($_SESSION['username'])) {
            return ["success" => false, "message" => "User is not logged in!"];
        }
    
        // Ensure 'id' is present in the task data
        if (!isset($taskData['id']) || empty($taskData['id'])) {
            return ["success" => false, "message" => "Task ID is missing."];
        }
    
        // Process datetime fields
        $taskData['due_date'] = $this->validateDateTime($taskData['due_date']);
        $taskData['reminder'] = $this->validateDateTime($taskData['reminder']);
    
        // Prepare the SQL query to update the task
        $sql = "UPDATE tasks SET title = :title, due_date = :due_date, reminder = :reminder, 
                priority = :priority, category = :category, flag = :flag WHERE id = :id";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
    
        // Bind parameters and execute the query
        try {
            // Check if the update is successful
            if ($stmt->execute([
                ':title' => $taskData['title'],
                ':due_date' => $taskData['due_date'],
                ':reminder' => $taskData['reminder'],
                ':priority' => $taskData['priority'],
                ':category' => $taskData['category'],
                ':flag' => $taskData['flag'],
                ':id' => $taskData['id']
            ])) {
                // Check if any rows were affected (i.e., task was updated)
                if ($stmt->rowCount() > 0) {
                    return ["success" => true, "message" => "Task updated successfully!"];
                } else {
                    // If no rows were affected, it could be due to an invalid task ID
                    return ["success" => false, "message" => "No rows affected. Possibly invalid task ID."];
                }
            } else {
                return ["success" => false, "message" => "Error updating task."];
            }
        } catch (PDOException $e) {
            // Catch any errors during execution and return an error message
            return ["success" => false, "message" => "Error executing query: " . $e->getMessage()];
        }
    }
    
    // Delete a task
    public function deleteTask($taskIndex) {
        if (!isset($_SESSION['username'])) {
            return ['success' => false, 'message' => 'User is not logged in!'];
        }

        // Check if task exists
        $checkSql = "SELECT * FROM tasks WHERE id = :taskIndex";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->execute([':taskIndex' => $taskIndex]);
        $result = $checkStmt->fetch();

        if (!$result) {
            return ['success' => false, 'message' => 'Task not found in the database.'];
        }

        // If task exists, delete it
        $sql = "DELETE FROM tasks WHERE id = :taskIndex";
        $stmt = $this->conn->prepare($sql);

        if ($stmt->execute([':taskIndex' => $taskIndex])) {
            return ['success' => true, 'message' => 'Task deleted successfully!'];
        } else {
            return ['success' => false, 'message' => 'Error deleting task.'];
        }
    }


// In your TaskClass or relevant model file
public function getUserTasks($username) {
    // Check if the user is logged in
    if (!isset($_SESSION['username']) || $_SESSION['username'] !== $username) {
        return ["success" => false, "message" => "User is not logged in or username mismatch"];
    }

    // SQL query to fetch tasks for the logged-in user
    $sql = "SELECT id, title, due_date, reminder, priority, category, flag FROM tasks WHERE username = :username";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Fetch all tasks
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the tasks
    if ($tasks) {
        return ["success" => true, "tasks" => $tasks];
    } else {
        return ["success" => false, "message" => "No tasks found."];
    }
}

    
}
?>
