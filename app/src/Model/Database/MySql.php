<?php

namespace App\Model\Database;

use PDO;

class MySql
{

    private static $PDO;

    public static function connect()
    {
        if (is_null(self::$PDO)) {

            try {
                self::$PDO = new PDO("mysql:host=". DB_HOST,DB_USER, DB_PASS);
                self::$PDO->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);

                $createDB = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
                self::$PDO->exec($createDB);

            } catch (\Exception $exception) {
                echo 'Erro ao conectar';
                error_log($exception->getMessage());
            }
        }

        return self::$PDO;
    }

}