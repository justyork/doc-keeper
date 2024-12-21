<?php
require_once __DIR__ . '/../controllers/AdminController.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('File ID is required.');
}

$controller = new AdminController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($id);
} else {
    $controller->edit($id);
}