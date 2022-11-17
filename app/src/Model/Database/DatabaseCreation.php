<?php

namespace App\Model\Database;

class DatabaseCreation
{

    public static ?DatabaseCreation $databaseCreation = null;

    public static function create()
    {

        $pdo = DatabaseConnection::$pdo;
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