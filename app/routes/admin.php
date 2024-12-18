<?php

// Просмотр данных
require_once __DIR__ . '/../controllers/AdminController.php';
$controller = new AdminController();
$controller->showAll();