<?php

namespace App\Model\Database;

use PHPUnit\Framework\MockObject\RuntimeException;

class DatabaseCreation
{
    public static $database;
    public static \PDO|null $pdo = null;

    public function __construct()
    {
        self::$pdo = (new DatabaseConnection())->connect();
    }

    public function create(): bool
    {
        try {
            $this->createDatabase();
            $this->createTable();

            return self::$database = true;
        } catch (\Exception $exception) {
            self::$database = false;

            throw new \InvalidArgumentException('Não foi possível continuar a execução');
        }
    }

    public function createDatabase(): false|int
    {
        return self::$pdo->exec('CREATE DATABASE IF NOT EXISTS ' . DB_NAME . '; USE ' . DB_NAME . ';');
    }

    public function createTable(): false|int
    {
        $createTable = "
                            CREATE TABLE IF NOT EXISTS Transactions(
                                idTransaction int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                description varchar(255) NOT NULL,
                                price float NOT NULL,
                                category varchar(45) NOT NULL,
                                date varchar(10) NOT NULL,
                                type TINYINT NOT NULL);";

        return self::$pdo->exec($createTable);

    }
}