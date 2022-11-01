<?php

require __DIR__ . "/vendor/autoload.php";

use App\Controller\Pages\Home;

const PATH_URL = 'https://localhost:8080/home';
const DB_HOST = 'localhost';
const DB_NAME = 'iomanager';
const DB_USER = 'root';
const DB_PASS = 12345;

echo Home::getHome();