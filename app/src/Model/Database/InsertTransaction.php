<?php

namespace App\Model\Database;

use App\Controller\NewTransaction;

class InsertTransaction
{

    private static ?DatabaseConnection $databaseConnection = null;
    private static NewTransaction $transaction;

    public function __construct()
    {
        self::$transaction = new NewTransaction();

        self::$databaseConnection = new DatabaseConnection();
        self::$databaseConnection::connect();

        (self::$databaseConnection::$pdo)->exec('USE ' . DB_NAME . ';');
    }

    public static function insert(): void
    {

        extract(self::$transaction::processRequest(), EXTR_OVERWRITE);

        $statement = self::$databaseConnection::$pdo->
        prepare("INSERT INTO Transactions (description, price, category, date, type) VALUES 
            (:description, :price, :category, :date, :type);");

        $statement->bindParam(':description', $description, self::$databaseConnection::$pdo::PARAM_STR);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':category', $category, self::$databaseConnection::$pdo::PARAM_STR);
        $statement->bindParam(':date', $date, self::$databaseConnection::$pdo::PARAM_STR);
        $statement->bindParam(':type', $type , self::$databaseConnection::$pdo::PARAM_INT);

        try {

            $statement->execute();
            header('Location: /home');

        } catch (\PDOException $PDOException) {
            echo "Error: " . $PDOException->getMessage();
            http_response_code(500);
        }

    }
}