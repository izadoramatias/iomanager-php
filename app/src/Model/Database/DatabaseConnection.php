<?php

namespace App\Model\Database;

use PDO;

class DatabaseConnection
{

    public static ?PDO $pdo = null;

    public static function connect()
    {

        define("App\Model\Database\DB_HOST", 'localhost');
        define("App\Model\Database\DB_NAME", 'iomanager');
        define("App\Model\Database\DB_USER", 'root');
        define("App\Model\Database\DB_PASS", 12345);

        if (is_null(self::$pdo)) {

            try {
                self::$pdo = new PDO("mysql:host=" . DB_HOST . ";", DB_USER, DB_PASS);
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);

                self::$pdo->exec('USE ' . DB_NAME . ';');

            } catch (\Exception $exception) {
                echo 'Erro ao conectar';
                error_log($exception->getMessage());
            }
        }

        return self::$pdo;
    }

}