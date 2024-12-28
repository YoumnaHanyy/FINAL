<?php
require_once '../Model/TaskClass.php';
require_once '../DB/db.php';

class TaskController {
    public function handleRequest() {
        // Check if any POST data was received
        if (empty($_POST)) {
            $this->sendResponse("No data received.", 400);
            return;
        }

        // Verify action parameter exists
        if (!isset($_POST['action'])) {
            $this->sendResponse("Missing action parameter.", 400);
            return;
        }

        // Verify database connection
        global $db;
        if (!$db) {
            $this->sendResponse("Database connection failed.", 500);
            return;
        }

        $taskClass = new TaskClass($db);
        $action = $_POST['action'];

        try {
            switch ($action) {
                case 'create':
                    $this->handleCreate($taskClass);
                    break;

                case 'update':
                    $this->handleUpdate($taskClass);
                    break;

                case 'delete':
                    $this->handleDelete($taskClass);
                    break;

                case 'getTasks':
                    $this->handleGetTasks($taskClass);
                    break;

                default:
                    $this->sendResponse("Invalid action: " . $action, 400);
                    break;
            }
        } catch (Exception $e) {
            $this->sendResponse("Error processing request: " . $e->getMessage(), 500);
        }
    }

    private function handleCreate($taskClass) {
        $requiredFields = ['title', 'due_date', 'reminder', 'priority', 'category', 'flag'];
        
        // Validate required fields
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field])) {
                $this->sendResponse("Missing required field: " . $field, 400);
                return;
            }
        }

        $taskData = [
            'title' => $_POST['title'],
            'due_date' => $_POST['due_date'],
            'reminder' => $_POST['reminder'],
            'priority' => $_POST['priority'],
            'category' => $_POST['category'],
            'flag' => $_POST['flag']
        ];

        $result = $taskClass->createTask($taskData);
        $this->sendResponse($result, 200);
    }

    private function handleUpdate($taskClass) {
        // Check for required task ID
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            $this->sendResponse("Task ID is required for updates.", 400);
            return;
        }

        $taskData = [
            'id' => $_POST['id'],
            'title' => $_POST['title'] ?? '',
            'due_date' => $_POST['due_date'] ?? '',
            'reminder' => $_POST['reminder'] ?? '',
            'priority' => $_POST['priority'] ?? 'Low',
            'category' => $_POST['category'] ?? '',
            'flag' => $_POST['flag'] ?? 0
        ];

        $result = $taskClass->updateTask($taskData);
        
        if ($result === true) {
            $this->sendResponse("Task updated successfully", 200);
        } else {
            $this->sendResponse("Failed to update task: " . $result, 400);
        }
    }

    private function handleDelete($taskClass) {
        if (!isset($_POST['id'])) {
            $this->sendResponse("Task ID is required for deletion.", 400);
            return;
        }

        $result = $taskClass->deleteTask($_POST['id']);
        
        if ($result === true) {
            $this->sendResponse("Task deleted successfully", 200);
        } else {
            $this->sendResponse("Failed to delete task: " . $result, 400);
        }
    }

    private function handleGetTasks($taskClass) {
        $tasks = $taskClass->getTasksByUser();
        header('Content-Type: application/json');
        echo json_encode($tasks);
        exit;
    }

    private function sendResponse($message, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode(['message' => $message, 'status' => $statusCode]);
        exit;
    }
}

// Instantiate and run the controller
try {
    $controller = new TaskController();
    $controller->handleRequest();
} catch (Exception $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode([
        'message' => "Unhandled exception: " . $e->getMessage(),
        'status' => 500
    ]);
}