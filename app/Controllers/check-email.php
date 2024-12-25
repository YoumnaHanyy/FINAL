<?php
require_once __DIR__ . '/../DB/config.php';
require_once __DIR__ . '/../Model/UserModel.php';

$userModel = new UserModel($servername, $username, $password, $dbname);
$email = $_GET['email'] ?? '';

$response = ['exists' => $userModel->doesEmailExist($email)];
echo json_encode($response);

$userModel->closeConnection();
?>
