<?php

namespace App\Model\Database;

use App\Controller\NewTransaction;
use App\Helper\FlashMessageTrait;

class InsertTransaction
{
    private static NewTransaction $transaction;
    use FlashMessageTrait;

    public function __construct()
    {
        self::$transaction = new NewTransaction();
        (DatabaseConnection::$pdo)->exec('USE ' . DB_NAME . ';');
    }

    public static function insert(): void
    {
        extract(self::$transaction::processRequest(), EXTR_OVERWRITE);

        $statement = DatabaseConnection::$pdo->
        prepare("INSERT INTO Transactions (description, price, category, date, type) VALUES 
            (:description, :price, :category, :date, :type);");

        $statement->bindParam(':description', $description, DatabaseConnection::$pdo::PARAM_STR);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':category', $category, DatabaseConnection::$pdo::PARAM_STR);
        $statement->bindParam(':date', $date, DatabaseConnection::$pdo::PARAM_STR);
        $statement->bindParam(':type', $type , DatabaseConnection::$pdo::PARAM_INT);

        try {

            $statement->execute();
            (new InsertTransaction)->messageDefinition('success', 'Transação cadastrada com sucesso!');
            header('Location: /home');

        } catch (\PDOException $PDOException) {
            (new InsertTransaction)->messageDefinition('danger', "Error: " . $PDOException->getMessage());
            header('Location: /home');
        }
    }
}