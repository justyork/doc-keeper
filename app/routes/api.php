<?php
require_once __DIR__ . '/../controllers/ApiController.php';
header('Content-Type: application/json');

$controller = new ApiController();
if (!isset($_GET['action'])) {
    header('Status: 400 Bad Request');
    exit();
}
$id = (int)$_GET['id'];

switch ($_GET['action']) {
    case 'subtopics':
        $controller->subtopics($id);
        break;
    case 'standards':
        $controller->standards($id);
        break;
    default:
        header('Status: 404 Not Found');
        exit();
}