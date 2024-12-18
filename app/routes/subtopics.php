<?php
require_once __DIR__ . '/../controllers/SubtopicController.php';
require_once __DIR__ . '/../helpers/Crud.php';

$controller = new SubtopicController();
Crud::route($controller);