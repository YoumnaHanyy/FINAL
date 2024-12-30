
<?php
require_once __DIR__ . '/../DB/config.php';
require_once __DIR__ . '/../Controllers/UserController.php';
require_once __DIR__ . '/../Model/UserModel.php';

// Initialize Model and Controller
$userModel = new UserModel($servername, $username, $password, $dbname);
$userController = new UserController($userModel);

// Get data from the AJAX request
$data = [
    'old_username' => $_POST['old_username'],
    'new_username' => $_POST['new_username'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
];

// Process update and send response
echo $userController->updateUser($data);

// Close the database connection
$userModel->closeConnection();

?>
