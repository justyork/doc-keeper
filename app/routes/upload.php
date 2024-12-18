<?php
require_once __DIR__ . '/../controllers/UploadController.php';

$errors = [];
$controller = new UploadController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $controller->handleUpload();
        header('Location: /upload.php?success=1');
        exit;
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }
} else {
    if (method_exists($controller, 'render')) {
        $controller->render([]);
    } else {
        die('Error: Method render not found in UploadController.');
    }
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color: red'>" . htmlspecialchars($error) . "</p>";
    }
}

if (isset($_GET['success'])) {
    echo "<p style='color: green'>File uploaded successfully!</p>";
}