<?php
require_once __DIR__ . '/../controllers/SubjectController.php';
require_once __DIR__ . '/../helpers/Crud.php';

$controller = new SubjectController();
Crud::route($controller);