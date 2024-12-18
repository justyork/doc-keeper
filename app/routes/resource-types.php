<?php
require_once __DIR__ . '/../controllers/ResourceTypeController.php';
require_once __DIR__ . '/../helpers/Crud.php';

$controller = new ResourceTypeController();
Crud::route($controller);