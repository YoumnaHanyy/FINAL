
<?php
require_once __DIR__ . '/../DB/config.php';
require_once __DIR__ . '/../Controllers/UserController.php';
require_once __DIR__ . '/../Model/UserModel.php';

// Check request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
    exit;
}

// Parse JSON input
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['username'])) {
    echo json_encode(["status" => "error", "message" => "Username is not set."]);
    exit;
}

// Initialize Model and Controller
$userModel = new UserModel($servername, $username, $password, $dbname);
$userController = new UserController($userModel);

// Process deletion
$response = $userController->deleteUser($data['username']);

// Close the database connection
$userModel->closeConnection();

// Return response
echo $response;
?>
