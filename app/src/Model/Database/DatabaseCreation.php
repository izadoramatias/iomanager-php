<?php

namespace App\Model\Database;

class DatabaseCreation
{
    private string $databaseName;
    public \PDO $pdo;

    public function __construct(
        string $databaseName,
        \PDO $pdo
    ) {
        $this->databaseName = $databaseName;
        $this->pdo = $pdo;
    }

    public function createDatabase()
    {
        try {
            $result = $this->pdo->exec('CREATE DATABASE IF NOT EXISTS ' . $this->databaseName . ';');

            if ($result === false) {
                throw new \PDOException('Não foi possível executar essa ação!');
            }

            return $this->pdo;
        } catch (\PDOException $PDOException) {
            echo $PDOException->getMessage() . PHP_EOL;
            die();
        }
    }

    public function useDatabase(): \PDO
    {
        try {
            $result = $this->pdo->exec('USE ' . $this->databaseName . ';');

            if (is_numeric($result) === false) {
                throw new \PDOException('Não foi possível executar essa ação!');
            }
            return $this->pdo;
        } catch (\PDOException $PDOException) {
            print_r($PDOException->getMessage());
        }
    }

    public function createTable(): \PDO
    {
        try {
            $createTable = "
                            CREATE TABLE IF NOT EXISTS Transactions(
                                idTransaction int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                description varchar(255) NOT NULL,
                                price float NOT NULL,
                                category varchar(45) NOT NULL,
                                date varchar(10) NOT NULL,
                                type TINYINT NOT NULL);";

            $result = $this->pdo->exec($createTable);

            if (is_numeric($result) === false) {
                throw new \PDOException('Não foi possível executar essa ação!');
            }

            return $this->pdo;
        } catch (\PDOException $PDOException) {
            print_r($PDOException->getMessage());
        }
    }
}