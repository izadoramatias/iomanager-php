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
        $result = $this->pdo->exec('CREATE DATABASE IF NOT EXISTS ' . $this->databaseName . ';');

        if ($result === false) {
            throw new \PDOException('Não foi possível continuar esta ação!');
        }

        return $this->pdo;
    }

    public function useDatabase(): \PDO
    {
        $result = $this->pdo->exec('USE ' . $this->databaseName . ';');

        if (is_numeric($result) === false) {
            throw new \PDOException('Não foi possível executar essa ação!');
        }
        return $this->pdo;
    }

    public function createTable(): \PDO
    {
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
    }
}