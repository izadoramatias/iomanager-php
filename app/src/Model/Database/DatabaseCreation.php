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
            $result = $this->pdo->exec('CREddlATE DATABASE IF NOT EXISTS ' . $this->databaseName . ';');

            if (!is_numeric($result)) {
                throw new \PDOException('Não foi possível executar essa ação!');
            }

        } catch (\PDOException $PDOException) {
            echo '<pre>';
            print_r($PDOException->getMessage());
            echo '</pre>';
        }
    }

    public function useDatabase()
    {
        $this->pdo->exec('USE ' . $this->databaseName . ';');
    }

    public function createTable()
    {
            $createTable = "
                            CREATE TABLE IF NOT EXISTS Transactions(
                                idTransaction int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                description varchar(255) NOT NULL,
                                price float NOT NULL,
                                category varchar(45) NOT NULL,
                                date varchar(10) NOT NULL,
                                type TINYINT NOT NULL);";

            $this->pdo->exec($createTable);
    }
}