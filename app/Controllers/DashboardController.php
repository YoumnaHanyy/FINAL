<?php

// controllers/DashboardController.php
require_once __DIR__ . '/../Model/UserModel.php';

class DashboardController {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function getDashboardData() {
        try {
            $sql = "SELECT COUNT(*) as user_count FROM users";
            $stmt = $this->db->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC); // Corrected method

            return $result ?: ['user_count' => 0]; // Return 0 if no results are found
        } catch (Exception $e) {
            // Log error and return a fallback value
            error_log("Error fetching dashboard data: " . $e->getMessage());
            return ['user_count' => 0];
        }
    }
    public function getUserData() {
        try {
            $sql = "SELECT username, email, password FROM users";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll for multiple rows
        } catch (Exception $e) {
            error_log("Error fetching user data: " . $e->getMessage());
            return []; // Return an empty array on error
        }
    }
}
?>
