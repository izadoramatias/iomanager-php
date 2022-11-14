<?php

namespace App\Model\Repository;

use App\Model\Database\DatabaseConnection;

class TransactionsTypeInput
{
    private static ?DatabaseConnection $databaseConnection = null;

    public function __construct()
    {

        self::$databaseConnection = new DatabaseConnection();
        self::$databaseConnection::connect();
    }

    public function findTransactionsTypeInput()
    {
        $query = "SELECT SUM(price) AS 'totalPriceInputs' FROM Transactions WHERE type LIKE 0x01;";
        $findTransactionsTypeInput = (self::$databaseConnection::$pdo)->prepare($query);
        $findTransactionsTypeInput->execute();

        $allTransactionsInput = $findTransactionsTypeInput->fetchAll();
        return $allTransactionsInput;
    }

}
