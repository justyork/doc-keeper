<?php
require_once __DIR__ . '/../controllers/AdminController.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('File ID is required.');
}

$controller = new AdminController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'description' => $_POST['description'],
        'subject' => $_POST['subject'],
        'subtopic' => $_POST['subtopic'],
        'standard' => $_POST['standard'],
        'resource_type' => $_POST['resource_type'],
    ];
    $controller->update($id, $data);
} else {
    $controller->edit($id);
}