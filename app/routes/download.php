<?php
require_once __DIR__ . '/../controllers/DownloadController.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('File ID is required.');
}

$controller = new DownloadController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->download($id);
} else {
    $controller->render($id);
}