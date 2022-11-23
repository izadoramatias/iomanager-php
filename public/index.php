<?php

require __DIR__ . '/../vendor/autoload.php';
use App\Controller\InterfaceRequestController;
use App\Controller\Pages\NotFound;
use App\Model\Database\DatabaseConnection;
use App\Model\Database\DatabaseCreation;

// refatorar para não enviar os dados do banco para o github (???)
define("App\Model\Database\DB_HOST", 'localhost');
define("App\Model\Database\DB_NAME", 'iomanager');
define("App\Model\Database\DB_USER", 'root');
define("App\Model\Database\DB_PASS", 12345);

$routes = require __DIR__ . '/../config/routes.php';

session_start();

// verifica se já há uma conexão com o banco, caso nao exista, o código abaixo irá criar e armazenar no atributo estático da classe
$databaseConnection = DatabaseConnection::$databaseConnection;
if (is_null($databaseConnection)) {
    DatabaseConnection::$databaseConnection = new DatabaseConnection();
    DatabaseConnection::connect();
}

// verifica se existe o banco de dados existe, caso não, uma instancia será criada
$databaseCreation = DatabaseCreation::$databaseCreation;
if (is_null($databaseCreation)) {
    DatabaseCreation::$databaseCreation = new DatabaseCreation();
    DatabaseCreation::create();
}

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


