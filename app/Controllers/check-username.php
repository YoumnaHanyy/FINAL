<?php


require_once __DIR__ . '/../Model/UserModel.php';

// Database connection parameters
require_once __DIR__ . '/../DB/config.php';

$userModel = new UserModel($servername, $username, $password, $dbname);
$username = $_GET['username'] ?? '';

$response = ['exists' => $userModel->doesUsernameExist($username)];
echo json_encode($response);

$userModel->closeConnection();
?>