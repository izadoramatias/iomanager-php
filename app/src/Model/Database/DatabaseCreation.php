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

    public function createDatabase()
    {
        try {
            $this->create();
        } catch (\Exception $exception) {
            throw new $exception->getMessage();
        }

        return self::$database = $this->createDatabase();
    }

    public function create(): bool
    {
        try {
            self::$pdo->exec('CREATE DATABASE IF NOT EXISTS ' . DB_NAME . '; USE ' . DB_NAME . ';');
            self::$pdo->exec($this->createTable());

            return self::$database = true;
        } catch (\Exception $exception) {
            self::$database = false;

            throw new RuntimeException('Não foi possível continuar a execução!');
        }
    }

    public function createTable(): string
    {
        $createTable = "
                            CREATE TABLE IF NOT EXISTS Transactions(
                                idTransaction int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                description varchar(255) NOT NULL,
                                price float NOT NULL,
                                category varchar(45) NOT NULL,
                                date varchar(10) NOT NULL,
                                type TINYINT NOT NULL);";
        return $createTable;
    }
}