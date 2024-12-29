<?php
require_once '../app/controllers/UserController.php';

$controller = new UserController();

if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
    $action = $_GET['action'];
    $controller->$action();
} else {
    $controller->index();
}


if ($_GET['action'] === 'check-username') {
    require_once __DIR__ . '/Controllers/UserController.php';
    $userController = new UserController();
    echo $userController->checkUsername($_GET['username']);
} elseif ($_GET['action'] === 'check-email') {
    require_once __DIR__ . '/Controllers/UserController.php';
    $userController = new UserController();
    echo $userController->checkEmail($_GET['email']);
}
require_once __DIR__ . '/controllers/DashboardController.php';

$dashboardController = new DashboardController();
$dashboardController->renderDashboard();


$controller = new TaskController();
$controller->fetchSortedTasks();





?>