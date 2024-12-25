<?php
// add-user.php

require_once __DIR__ . '/../DB/config.php';
require_once __DIR__ . '/../Controllers/UserController.php';
require_once __DIR__ . '/../Model/UserModel.php';

 
// Database configuration
 
// Initialize Model and Controller
$userModel = new UserModel($servername, $username, $password, $dbname);
$userController = new UserController($userModel);

// Get data from the AJAX request
$data = [
    'username' => $_POST['username'] ?? '',
    'email' => $_POST['email'] ?? '',
    'password' => $_POST['password'] ?? '',
];

// Process addition and send response
echo $userController->addUser($data);

// Close the database connection
$userModel->closeConnection();

 ?>
