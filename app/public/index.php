<?php

require __DIR__ . '/../../vendor/autoload.php';

use App\Controller\InterfaceRequestController;

$path = $_SERVER['PATH_INFO'];
$routes = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($path, $routes)) {
    http_response_code(404);
    exit();
}

$controllerClass = $routes[$path];

/** @var InterfaceRequestController $controller */
$controller = new $controllerClass();
$controller::processRequest();

const PATH_URL = 'https://localhost:8080/home';
const DB_HOST = 'localhost';
const DB_NAME = 'iomanager';
const DB_USER = 'root';
const DB_PASS = 12345;

//echo Home::getHome();