<?php

namespace App\Model\Database;

class DatabaseCreation
{
    public static $database;
    public static \PDO|null $pdo = null;

    public function __construct()
    {
        self::$pdo = DatabaseConnection::connect();
    }

    public static function createDatabase()
    {
        if (isset(self::$database)) {
            return self::$database;
        }

        try {
            self::$database = self::create();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            exit();
        }

        return self::$database;
    }

    public static function create(): void
    {
        $createDB = 'CREATE DATABASE IF NOT EXISTS ' . DB_NAME . ';';
        self::$pdo->exec($createDB);
        self::$pdo->exec('USE ' . DB_NAME . ';');

        self::createTable();
    }

    private static function createTable(): void
    {
        $createTable = "
                            CREATE TABLE IF NOT EXISTS Transactions(
                                idTransaction int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                description varchar(255) NOT NULL,
                                price float NOT NULL,
                                category varchar(45) NOT NULL,
                                date varchar(10) NOT NULL,
                                type TINYINT NOT NULL);";
        self::$pdo->exec($createTable);
    }
}