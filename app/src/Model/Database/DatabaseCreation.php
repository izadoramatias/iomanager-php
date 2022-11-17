<?php

namespace App\Model\Database;

class DatabaseCreation
{

    private static ?DatabaseConnection $databaseConnection = null;

    public function __construct()
    {
        self::$databaseConnection = new DatabaseConnection();
        self::$databaseConnection::connect();
    }

    public static function create()
    {

        $pdo = self::$databaseConnection::$pdo;
        try {

            $createDB = 'CREATE DATABASE IF NOT EXISTS ' . DB_NAME . ';';
            $pdo->exec($createDB);
            $pdo->exec('USE ' . DB_NAME . ';');

            $createTable =  "
                            CREATE TABLE IF NOT EXISTS Transactions(
                                idTransaction int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                description varchar(255) NOT NULL,
                                price float NOT NULL,
                                category varchar(45) NOT NULL,
                                date varchar(10) NOT NULL,
                                type TINYINT NOT NULL);";
            $pdo->exec($createTable);

        } catch (\PDOException $exception) {

            echo 'Erro ao criar a base de dados ou a tabela!';
            error_log($exception->getMessage());
        }
    }

}