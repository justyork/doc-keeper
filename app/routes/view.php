<?php
require_once __DIR__ . '/../controllers/ViewController.php';

$controller = new ViewController();
$filters = [
    'subject' => $_GET['subject'] ?? null,
    'subtopic' => $_GET['subtopic'] ?? null,
];
$controller->render($filters);
