<?php

namespace Manager\Core;
use Manager\Model\Transaction;
use PDO;

class Database extends PDO
{

    private $DB_NAME = 'IOManagement';
    private $DB_USER = 'root';
    private $DB_PASSWORD = '12345';
    private $DB_HOST = 'localhost';

    private $conn;
    private Transaction $transaction;

    public function  __construct(

    ) {
        try {

            $this->conn = new PDO("mysql:host=$this->DB_HOST;user=$this->DB_USER;password=$this->DB_PASSWORD");

            $this->databaseCreate();
            $this->databaseConnect();
            $this->createTable();            

        } catch (\PDOException $PDOException) {

            echo $PDOException->getMessage() . PHP_EOL;
        }

    }

    private function databaseCreate(): void
    {
        $sql = "CREATE DATABASE IF NOT EXISTS $this->DB_NAME";

        // create database
        $this->conn->exec($sql);
        echo 'Database created successfully!' . PHP_EOL;
    }

    private function databaseConnect(): void
    {
        $this->conn->exec("USE $this->DB_NAME");
        echo 'Database connect successfully!' . PHP_EOL;
    }
    
    private function createTable(): void
    {
        $sqlTable = "CREATE TABLE IF NOT EXISTS Transactions (
                idTransaction INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                description VARCHAR(45) NOT NULL,
                price DECIMAL(10, 2) NOT NULL,
                category VARCHAR(45) NOT NULL,
                io BOOLEAN NOT NULL
            )";

        $this->conn->exec($sqlTable);
        echo 'Table created successfully!' . PHP_EOL;
    }

    public function insertDataOnTable(Transaction $transaction)
    {

        $description = $transaction->getDescription();
        $price = $transaction->getPrice();
        $category = $transaction->getCategory();
        $io = (int)($transaction->getIO());

        try {
            $insertSql = 'INSERT INTO Transactions (description, price, category, io)
            VALUES (?, ?, ?, ?);';

            $statement = $this->conn->prepare($insertSql);
            $result = $statement->execute([$description, $price, $category, $io]);

            echo 'inserido com sucesso!' . PHP_EOL;
        } catch (\PDOException $PDOException) {
            echo $PDOException->getMessage() . PHP_EOL;
        }

    }

}

