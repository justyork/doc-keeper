<?php
require_once __DIR__ . '/../controllers/UploadController.php';

$errors = [];
$controller = new UploadController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleUpload();
} else {
    $controller->render();
}

