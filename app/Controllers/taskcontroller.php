<?php
require_once '../Model/TaskClass.php';
require_once '../DB/db.php';

class TaskController {
    private $taskClass;

    public function __construct() {
        // Initialize database connection and TaskClass
        $db = new Database();
        $this->taskClass = new TaskClass($db);
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendResponse(false, "Invalid request method. Only POST is allowed.");
            return;
        }

        if (!isset($_POST['action']) || empty($_POST['action'])) {
            $this->sendResponse(false, "Action is required.");
            return;
        }

        session_start(); // Ensure session is started
        if (!isset($_SESSION['username'])) {
            $this->sendResponse(false, "User is not logged in.");
            return;
        }

        $username = $_SESSION['username'];
        $action = $_POST['action'];

        try {
            switch ($action) {
                case 'create':
                    $this->handleCreate($username);
                    break;

                case 'update':
                    $this->handleUpdate();
                    break;

                case 'delete':
                    $this->handleDelete();
                    break;

                case 'fetch':
                    $this->handleFetch($username);
                    break;

                default:
                    $this->sendResponse(false, "Invalid action: $action.");
                    break;
            }
        } catch (Exception $e) {
            $this->sendResponse(false, "An error occurred: " . $e->getMessage());
        }
    }

    private function handleCreate($username) {
        $requiredFields = ['title', 'due_date', 'reminder', 'priority', 'category', 'flag'];
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                $this->sendResponse(false, "Missing required field: $field.");
                return;
            }
        }

        $taskData = [
            'title' => $_POST['title'],
            'due_date' => $_POST['due_date'],
            'reminder' => $_POST['reminder'],
            'priority' => $_POST['priority'],
            'category' => $_POST['category'],
            'flag' => (int)$_POST['flag'],
        ];

        $result = $this->taskClass->createTask($taskData, $username);
        $this->sendResponse($result['success'], $result['message']);
    }

    private function handleUpdate() {
        if (!isset($_POST['taskData']) || empty($_POST['taskData'])) {
            $this->sendResponse(false, "Task data is required for update.");
            return;
        }

        $taskData = json_decode($_POST['taskData'], true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->sendResponse(false, "Invalid task data format.");
            return;
        }

        $result = $this->taskClass->updateTask($taskData);
        $this->sendResponse($result['success'], $result['message']);
    }

    private function handleDelete() {
        if (!isset($_POST['taskIndex']) || empty($_POST['taskIndex'])) {
            $this->sendResponse(false, "Task index is required for deletion.");
            return;
        }

        $taskIndex = (int)$_POST['taskIndex'];
        $result = $this->taskClass->deleteTask($taskIndex);
        $this->sendResponse($result['success'], $result['message']);
    }

    private function handleFetch($username) {
        $result = $this->taskClass->getUserTasks($username);
        $this->sendResponse($result['success'], $result['message'], $result['tasks'] ?? []);
    }

    private function sendResponse($success, $message, $data = []) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ]);
        exit;
    }
}

// Instantiate and handle the request
$controller = new TaskController();
$controller->handleRequest();
?>
