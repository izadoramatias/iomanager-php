<?php

namespace App\Model\Database;
use PDO;

class DatabaseConnection
{
    public static PDO|null $pdo = null;

    public function connect(): PDO|null
    {
        try {
            self::$pdo = new PDO('mysql:host=' . DB_HOST . ';', DB_USER, DB_PASS);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $exception) {
            echo 'não foi possível carregar a pagina';
            error_log($exception->getMessage());
        }
        return self::$pdo;
    }
}
