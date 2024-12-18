<?php
require_once '../app/helpers/Dotenv.php';
Dotenv::load(__DIR__ . '/../.env');

require_once '../app/helpers/database.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routeFiles = glob(__DIR__ . '/../app/routes/*.php');

$routes = [];
foreach ($routeFiles as $file) {
    $route = '/' . basename($file, '.php');
    $routes[$route] = $file;
}

$defaultRoute = '/upload';

if ($requestUri === '/') {
    $requestUri = $defaultRoute;
}

foreach ($routes as $route => $filePath) {
    if (strpos($requestUri, $route) === 0) {
        if (file_exists($filePath)) {
            require_once $filePath;
        } else {
            http_response_code(404);
            echo "Error 404: File not found.";
        }
        exit;
    }
}

http_response_code(404);
echo "Error 404: Page not found.";