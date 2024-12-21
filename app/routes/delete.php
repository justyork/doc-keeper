<?php
require_once __DIR__ . '/../controllers/AdminController.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('File ID is required.');
}

(new AdminController())->delete($id);