<?php

require_once __DIR__ . '/../app/controllers/UploadController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';

// Проверяем тип запроса
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

session_start();

// Проверка авторизации
$adminActions = ['deleteUpload', 'uploadFile'];
if (in_array($action, $adminActions) && empty($_SESSION['logged_in'])) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

switch ($action) {
    case 'getUploads':
        if ($method === 'GET') {
            $controller = new ViewController();
            $filters = [
                'subject' => $_GET['subject'] ?? null,
                'subtopic' => $_GET['subtopic'] ?? null,
            ];
            $controller->render($filters);
        }
        break;

    case 'uploadFile':
        if ($method === 'POST') {
            $controller = new UploadController();
            $controller->handleUpload();
        }
        break;

    case 'getDropdownData':
        if ($method === 'GET') {
            $controller = new ViewController();
            $controller->getDropdownData();
        }
        break;

    case 'deleteUpload':
        if ($method === 'DELETE') {
            $controller = new AdminController();
            $controller->delete($_GET['id'] ?? null);
        }
        break;

    default:
        header("HTTP/1.0 404 Not Found");
        echo json_encode(['error' => 'Action not found']);
        break;
}