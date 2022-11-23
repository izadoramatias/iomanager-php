<?php

require __DIR__ . '/../../vendor/autoload.php';
use App\Controller\InterfaceRequestController;
use App\Controller\Pages\NotFound;

// refatorar para não enviar os dados do banco para o github (???)
define("App\Model\Database\DB_HOST", 'localhost');
define("App\Model\Database\DB_NAME", 'iomanager');
define("App\Model\Database\DB_USER", 'root');
define("App\Model\Database\DB_PASS", 12345);

$routes = require __DIR__ . '/../config/routes.php';

// verifica se o path info não está setado
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
