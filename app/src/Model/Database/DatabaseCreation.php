<?php

namespace App\Model\Database;

class DatabaseCreation
{

    public static function create()
    {

        try {

            $createDB = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
            self::$pdo->exec($createDB);

            $createTable =  "CREATE TABLE Transactions(
                                idTransaction int NOT NULL AUTO_INCREMENT,
                                description varchar(255) NOT NULL,
                                price float NOT NULL,
                                category varchar(45) NOT NULL,
                                io BIT NOT NULL                                
                            )";
            self::$pdo->exec($createTable);
            echo 'tabela criada com sucesso!';

        } catch (\PDOException $exception) {

            echo 'Erro ao criar a base de dados ou a tabela!';
            error_log($exception->getMessage());
        }
    }

}