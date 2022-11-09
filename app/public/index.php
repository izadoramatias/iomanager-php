<?php

require __DIR__ . '/../../vendor/autoload.php';
use App\Controller\InterfaceRequestController;
use App\Controller\Pages\NotFound;

$routes = require __DIR__ . '/../config/routes.php';


if (!isset($_SERVER['PATH_INFO'])) {
    $_SERVER['PATH_INFO'] = '/home';
    header("Location: " . $_SERVER['PATH_INFO'], true, 302);
}

$path = $_SERVER['PATH_INFO'];
if (!array_key_exists($path, $routes)) {

    NotFound::processRequest();
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