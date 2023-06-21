<?php

namespace App\Model\Repository;

use App\Controller\NewTransaction;
use App\Helper\FlashMessageTrait;
use App\Model\Database\DatabaseConnection;
use App\Model\Database\PDOSingleConnection;
use App\Model\HomeModel;
use App\Model\TransactionModel;
use const App\Model\Database\DB_NAME;

class InsertTransaction
{
    private static TransactionModel $transaction;
    use FlashMessageTrait;

    public function __construct()
    {
        $transaction = new NewTransaction();
        self::$transaction = $transaction::processRequest();

        (PDOSingleConnection::getPDO())->exec('USE ' . DB_NAME . ';');
    }

    public static function insert(): void
    {
        $transactionData = self::$transaction;
        $date = $transactionData->date->format('d/m/Y');

        $statement = PDOSingleConnection::getPDO()->
        prepare("INSERT INTO Transactions (description, price, category, date, type) VALUES 
            (:description, :price, :category, :date, :type);");

        $statement->bindParam(':description', $transactionData->description, PDOSingleConnection::getPDO()::PARAM_STR);
        $statement->bindParam(':price', $transactionData->price);
        $statement->bindParam(':category', $transactionData->category, PDOSingleConnection::getPDO()::PARAM_STR);
        $statement->bindParam(':date', $date, PDOSingleConnection::getPDO()::PARAM_STR);
        $statement->bindParam(':type', $transactionData->type, PDOSingleConnection::getPDO()::PARAM_INT);

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