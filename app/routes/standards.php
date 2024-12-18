<?php
require_once __DIR__ . '/../controllers/StandardController.php';
require_once __DIR__ . '/../helpers/Crud.php';

$controller = new StandardController();
Crud::route($controller);