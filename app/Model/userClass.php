<?php

class TaskModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function createTask($taskData) {
        $sql = "INSERT INTO tasks (title, due_date, reminder, assigned_to, priority, category, flag)
                VALUES (:title, :due_date, :reminder, :assigned_to, :priority, :category, :flag)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($taskData);
    }

    public function getTasks() {
        $sql = "SELECT * FROM tasks";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

