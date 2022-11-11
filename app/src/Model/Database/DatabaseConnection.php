<?php

namespace App\Model\Database;

use PDO;

class DatabaseConnection
{

    public static ?PDO $pdo = null;

    public static function connect()
    {

        if (is_null(self::$pdo)) {

            try {

                self::$pdo = new PDO("mysql:host=" . DB_HOST . ";", DB_USER, DB_PASS);
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);

            } catch (\Exception $exception) {

                echo 'Erro ao conectar';
                error_log($exception->getMessage());
            }
        }

        return self::$pdo;
    }

}