<?php

namespace App\Model\Database;
use PDO;

abstract class DatabaseConnection
{
    public static PDO|null $pdo = null;

    public static function connect(): PDO
    {
        if (isset(self::$pdo)) {
            return self::$pdo;
        }

        try {
            self::$pdo = new PDO('mysql:host=' . DB_HOST . ';', DB_USER, DB_PASS);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $exception) {
            echo 'erro ao conectar';
            error_log($exception->getMessage());
        }

        return self::$pdo;
    }
}
