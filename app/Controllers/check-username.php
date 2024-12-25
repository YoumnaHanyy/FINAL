<?php
require_once __DIR__ . '/../DB/config.php';
require_once __DIR__ . '/../Model/UserModel.php';

$userModel = new UserModel($servername, $username, $password, $dbname);
$username = $_GET['username'] ?? '';

$response = ['exists' => $userModel->doesUsernameExist($username)];
echo json_encode($response);

$userModel->closeConnection();
?>
