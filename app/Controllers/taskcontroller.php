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

        global $db; // Assuming $db is initialized in db.php
        if (!$db) {
            echo "Database connection failed.";
            exit;
        }

        $taskClass = new TaskClass($db);

        $action = $_POST['action'];
        $result = "Unknown error occurred.";

        switch ($action) {
            case 'create':
                $requiredFields = ['title', 'due_date', 'reminder', 'priority', 'category', 'flag'];
                foreach ($requiredFields as $field) {
                    if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
                        
                    }
                }
            
                $taskData = [
                    'title' => $_POST['title'],
                    'due_date' => $_POST['due_date'],
                    'reminder' => $_POST['reminder'],
                    'priority' => $_POST['priority'],
                    'category' => $_POST['category'],
                    'flag' => $_POST['flag'],
                ];
                $result = $taskClass->createTask($taskData);

              
                
                break;

            case 'update':
                if (isset($_POST['id'], $_POST['title'], $_POST['due_date'], $_POST['reminder'], $_POST['priority'], $_POST['category'], $_POST['flag'])) {
                    $taskData = [
                        'id' => $_POST['id'],
                        'title' => $_POST['title'],
                        'due_date' => $_POST['due_date'],
                        'reminder' => $_POST['reminder'],
                        'priority' => $_POST['priority'],
                        'category' => $_POST['category'],
                        'flag' => $_POST['flag'],
                    ];
                    $result = $taskClass->updateTask($taskData);
                } else {
                    $result = "Task data missing.";
                }
                break;

            case 'delete':
                if (isset($_POST['taskId'])) {
                    $result = $taskClass->deleteTask($_POST['taskId']);
                } else {
                    $result = "Task ID missing.";
                }
                break;

            case 'getTasks':
                $tasks = $taskClass->getTasksByUser();
                echo json_encode($tasks);
                exit;

            default:
                $result = "Invalid action.";
                break;
        }

        echo $result;
        exit;
    }
}

try {
    $controller = new TaskController();
    $controller->handleRequest();
} catch (Exception $e) {
    echo "Unhandled exception: " . $e->getMessage();
    exit;
}
