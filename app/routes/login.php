<?php
require_once __DIR__ . '/../controllers/SiteController.php';

$controller = new SiteController();
if (isset($_POST['password'])) {
    $controller->login($_POST['password']);
}
$controller->renderLogin();

