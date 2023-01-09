<?php

namespace App\Model\Database;

use PDO;

class PDOSingleConnection
{
    private static PDO|null $pdo = null;

    public function __construct(PDO $pdo)
    {
        self::$pdo = $pdo;
    }

    public static function getPDO(
        $hostName = 'localhost',
        $username = 'root',
        $password = '12345'
    ): PDO
    {
        if (is_null(self::$pdo)) {
            try {
                self::$pdo = new PDO("mysql:host=$hostName;", $username, $password);
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $PDOException) {
                throw new \PDOException($PDOException->getMessage());
            }
        }

        return self::$pdo;
    }
}