<?php

namespace App\Model\Database;

class DatabaseCreation
{

    private static ?DatabaseConnection $databaseConnection = null;

    public function __construct()
    {
        self::$databaseConnection = new DatabaseConnection();
    }

    public static function create()
    {

        $pdo = self::$databaseConnection::$pdo;

        try {

            $createDB = 'CREATE DATABASE IF NOT EXISTS ' . DB_NAME . ';';
            $pdo->exec($createDB);

            $createTable =  "
                            CREATE TABLE IF NOT EXISTS TransactionsFindAll(
                                idTransaction int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                description varchar(255) NOT NULL,
                                price float NOT NULL,
                                category varchar(45) NOT NULL,
                                io bit NOT NULL);";
            $pdo->exec($createTable);

        } catch (\PDOException $exception) {

            echo 'Erro ao criar a base de dados ou a tabela!';
            error_log($exception->getMessage());
        }
    }

}