<?php
session_start();

// Define Base URL for assets and links
define('BASE_URL', 'http://localhost/pemrograman_web/');

// Autoload logic setup
require_once 'config/database.php';
require_once 'models/Book.php'; // Load Models manually as per strict structure
require_once 'controllers/Auth.php';
require_once 'controllers/Book.php';

// Routing Logic
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'dashboard';
$url = explode('/', $url);

$controllerName = ucfirst($url[0]);
$method = isset($url[1]) ? $url[1] : 'index';
$params = isset($url[2]) ? $url[2] : null;

// Route Protection: If not logged in, force login page
if (!isset($_SESSION['user_id']) && $controllerName !== 'Auth') {
    header("Location: " . BASE_URL . "auth/login");
    exit;
}

// Controller Dispatcher
if ($controllerName == 'Auth') {
    $controller = new Auth();
} elseif ($controllerName == 'Book') {
    $controller = new BookController();
} elseif ($controllerName == 'Dashboard') {
    // Simple inline controller for Dashboard to avoid creating new files
    require_once 'views/header.php';
    require_once 'views/dashboard.php';
    require_once 'views/footer.php';
    exit;
} else {
    // 404 Fallback
    echo "<h1>404 - Page Not Found</h1>";
    exit;
}

// Execute Method
if (method_exists($controller, $method)) {
    if ($params) {
        $controller->{$method}($params);
    } else {
        $controller->{$method}();
    }
} else {
    echo "Method not found";
}