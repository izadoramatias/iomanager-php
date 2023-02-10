<?php

namespace App\Model\Database;

use PDO;

class PDOSingleConnection
{
    protected static PDO|null $pdo = null;

    public static function getPDO(
        $hostName = 'localhost',
        $username = 'root',
        $password = 'fulltime12345'
    ): PDO
    {
        if (is_null(self::$pdo)) {
            self::createInstancePDO($hostName, $username, $password);
        }
        return self::$pdo;
    }

    protected static function createInstancePDO($hostName, $username, $password): void
    {
        self::$pdo = new PDO("mysql:host=$hostName;", $username, $password);
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}