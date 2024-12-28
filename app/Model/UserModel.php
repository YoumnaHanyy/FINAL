<?php

class UserModel {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function insertUser($data) {
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if (!$stmt) {
            return ["success" => false, "message" => "Statement preparation failed: " . $this->conn->error];
        }
        $stmt->bind_param("sss", $data['username'], $data['email'], $hashedPassword);
        $result = $stmt->execute();
        if (!$result) {
            return ["success" => false, "message" => "Execution failed: " . $stmt->error];
        }
        $stmt->close();
        return $result;
    }
    public function doesUsernameExist($username) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }
    
    public function doesEmailExist($email) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        return $count > 0;
    }
    
    public function getAllUsers() {
        $query = "SELECT username, email, password FROM users";
        $result = $this->conn->query($query);
        return $result;
    }

    public function updateUser($data) {
        $query = "UPDATE users SET username = ?, email = ?, password = ? WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssss", $data['new_username'], $data['email'], $data['password'], $data['old_username']);
        if ($stmt->execute()) {
            return ["status" => "success", "message" => "User updated successfully."];
        }
        return ["status" => "error", "message" => "Failed to update user."];
    }

    public function deleteUser($username) {
        $query = "DELETE FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
    
        if ($stmt->execute()) {
            return ["status" => "success", "message" => "User deleted successfully."];
        } else {
            return ["status" => "error", "message" => "Failed to delete user. Error: " . $stmt->error];
        }
    }
    
    public function getUsersWithTasks() {
        $sql = "
        SELECT 
            users.username,
            tasks.id AS task_id,
            tasks.title,
            tasks.due_date,
            tasks.reminder,
            tasks.priority,
            tasks.category,
            tasks.flag,
            tasks.completed_task
            tasks.created_at AS task_created_at
        FROM 
            users
        LEFT JOIN 
            tasks 
        ON 
            users.username = tasks.assigned_to
        ";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function countUsers() {
        $sql = "SELECT COUNT(*) AS total_users FROM users";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()["total_users"] ?? 0;
    }
    




    public function countTasks() {
        $sql = "SELECT COUNT(*) AS total_tasks FROM tasks";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()["total_tasks"] ?? 0;
    }
    
    public function countHighPriorityTasks() {
        $sql = "SELECT COUNT(*) AS high_priority_tasks FROM tasks WHERE priority = 'High'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc()["high_priority_tasks"] ?? 0;
    }
    

 
/////////////////////////////////////////////////





    public function closeConnection() {
        $this->conn->close();
    }

}