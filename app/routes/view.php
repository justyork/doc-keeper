<?php
require_once __DIR__ . '/../controllers/ViewController.php';

$controller = new ViewController();
$filters = [
    'subject' => $_GET['subject'] ?? null,
    'subtopic' => $_GET['subtopic'] ?? null,
    'standard' => $_GET['standard'] ?? null,
    'resource_type' => $_GET['resource_type'] ?? null,
];
$controller->render($filters);
