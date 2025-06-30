<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__. '/config/Db.php';
require_once __DIR__ . '/model/Auth.php';
require_once __DIR__ . '/model/Logs.php';
require_once __DIR__ . '/model/User.php';
require_once __DIR__ . '/controller/AuthController.php';
require_once __DIR__ . '/controller/LogsController.php';
require_once __DIR__ . '/controller/UserController.php';

$auth = new AuthController();
$logs = new LogsController();
$user = new UserController();

$page = $_GET['page'] ?? 'index';

switch ($page) {
    case 'index':
        $auth->index();
        break;
    case 'dashboard':
        $user->dashboard();
        break;
    case 'logs':
        require 'views/logs.php';
        break;
    case 'signin':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->signIn($_POST);
            header('location:index.php?page=dashboard');
            exit();
        } else {
            $auth->index();
        }
        break;
    case 'signup':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->signUp($_POST);
            header('location:index.php');
            exit();
        } else {
            $auth->index();
        }
        break;
    case 'logout':
        $auth->logout();
        break;
    case 'add-logs':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $logs->create($_POST);
            break;
        }
        break;
    case 'update-logs':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $logs->update($_POST);
            break;
        }
        break;
    default:
        echo "404 Not Found";
}