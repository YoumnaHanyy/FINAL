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

    public function closeConnection() {
        $this->conn->close();
    }
}