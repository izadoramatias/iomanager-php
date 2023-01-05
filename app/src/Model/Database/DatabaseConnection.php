<?php

namespace App\Model\Database;

use PDO;


class DatabaseConnection
{
    public static PDO|null $pdo = null;

    public function connect(string $host, string $username, string $password): PDO
    {
        try {
            self::$pdo = new PDO("mysql:host=$host;", $username, $password);
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $PDOException) {
            throw new \PDOException($PDOException->getMessage());
        }
        return self::$pdo;
    }
}
