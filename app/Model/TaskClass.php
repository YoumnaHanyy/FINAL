<?php

include_once 'LoginClass.php';
include_once 'taskcontroller.php';
include_once '../DB/db.php';

class TaskClass extends LoginClass {
    private $conn;

    public function __construct($db) {
        $this->conn = $db->getConnection();
    }

    public function createTask($taskData, $username) {
        try {
            $due_date = $this->validateDateTime($taskData['due_date']);
            $reminder = $this->validateDateTime($taskData['reminder']);

            $sql = "INSERT INTO tasks (title, due_date, reminder, assigned_to, priority, category, flag)
                    VALUES (:title, :due_date, :reminder, :assigned_to, :priority, :category, :flag)";
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':title' => $taskData['title'],
                ':due_date' => $due_date,
                ':reminder' => $reminder,
                ':assigned_to' => $username,
                ':priority' => $taskData['priority'],
                ':category' => $taskData['category'],
                ':flag' => $taskData['flag']
            ]);

            return ["success" => true, "message" => "Task created successfully and assigned to $username!"];
        } catch (Exception $e) {
            return ["success" => false, "message" => "Error creating task: " . $e->getMessage()];
        }
    }

    private function validateDateTime($value) {
        $dt = DateTime::createFromFormat('Y-m-d\TH:i', $value);
        return $dt ? $dt->format('Y-m-d H:i:s') : ($value ?: null);
    }

    public function updateTask($taskData) {
        try {
            $sql = "UPDATE tasks SET title = :title, due_date = :due_date, reminder = :reminder, 
                    priority = :priority, category = :category, flag = :flag WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':title' => $taskData['title'],
                ':due_date' => $this->validateDateTime($taskData['due_date']),
                ':reminder' => $this->validateDateTime($taskData['reminder']),
                ':priority' => $taskData['priority'],
                ':category' => $taskData['category'],
                ':flag' => $taskData['flag'],
                ':id' => $taskData['id']
            ]);

            return $stmt->rowCount() > 0
                ? ["success" => true, "message" => "Task updated successfully!"]
                : ["success" => false, "message" => "No rows affected. Invalid task ID?"];
        } catch (Exception $e) {
            return ["success" => false, "message" => "Error updating task: " . $e->getMessage()];
        }
    }

    public function deleteTask($taskIndex) {
        try {
            $sql = "DELETE FROM tasks WHERE id = :taskIndex";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':taskIndex' => $taskIndex]);

            return $stmt->rowCount() > 0
                ? ["success" => true, "message" => "Task deleted successfully!"]
                : ["success" => false, "message" => "Task not found."];
        } catch (Exception $e) {
            return ["success" => false, "message" => "Error deleting task: " . $e->getMessage()];
        }
    }

    public function getUserTasks($username) {
        try {
            $sql = "SELECT id, title, due_date, reminder, priority, category, flag 
                    FROM tasks 
                    WHERE assigned_to = :username";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':username' => $username]);

            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $tasks
                ? ["success" => true, "tasks" => $tasks]
                : ["success" => false, "message" => "No tasks found."];
        } catch (Exception $e) {
            return ["success" => false, "message" => "Error fetching tasks: " . $e->getMessage()];
        }
    }
}

?>
