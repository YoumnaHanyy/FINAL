<?php
require_once '../Model/TaskClass.php';
require_once '../DB/db.php';

class TaskController {

    public function handleRequest() {
        if (empty($_POST)) {
            echo "No data received.";
            exit;
        }

        if (!isset($_POST['action']) || empty($_POST['action'])) {
            echo "Invalid or missing action.";
            exit;
        }

        // Validate database connection
        global $db; // Assuming $db is initialized in db.php
        if (!$db) {
            echo "Database connection failed.";
            exit;
        }

        // Instantiate TaskClass
        $taskClass = new TaskClass($db);

        // Handle action
        $action = $_POST['action'];
        $result = "Unknown error occurred."; // Default response

        switch ($action) {
            case 'create':
                if (isset($_POST['title'], $_POST['due_date'], $_POST['reminder'], $_POST['priority'], $_POST['category'], $_POST['flag'])) {
                    $taskData = [
                        'title' => $_POST['title'],
                        'due_date' => $_POST['due_date'],
                        'reminder' => $_POST['reminder'],
                        'priority' => $_POST['priority'],
                        'category' => $_POST['category'],
                        'flag' => $_POST['flag'],
                    ];
                    $result = $taskClass->createTask($taskData);
                } else {
                    $result = "Task data missing.";
                }
                break;

            case 'update':
                if (isset($_POST['taskData'])) {
                    $result = $taskClass->updateTask($_POST['taskData']);
                } else {
                    $result = "Task data missing.";
                }
                break;

            case 'delete':
                if (isset($_POST['taskIndex'])) {
                    $result = $taskClass->deleteTask($_POST['taskIndex']);
                } else {
                    $result = "Task index missing.";
                }
                break;

            default:
                $result = "Invalid action.";
                break;
        }

        // Return plain text response
        echo $result;
        exit;
    }
}

// Instantiate and handle the request
try {
    $controller = new TaskController();
    $controller->handleRequest();
} catch (Exception $e) {
    echo "Unhandled exception: " . $e->getMessage();
    exit;
}
?>
