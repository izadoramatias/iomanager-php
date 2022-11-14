<?php

namespace App\Model\Repository;

use App\Model\Database\DatabaseConnection;

class TransactionsTypeOutput
{

    private static ?DatabaseConnection $databaseConnection = null;

    public function __construct()
    {

        self::$databaseConnection = new DatabaseConnection();
        self::$databaseConnection::connect();
    }

    public function findTransactionsTypeOutput()
    {

        $query = "SELECT SUM(price) AS 'totalPriceOutputs' FROM Transactions WHERE type LIKE 0x00;";
        $findTransactionsTypeOutput = (self::$databaseConnection::$pdo)->prepare($query);
        $findTransactionsTypeOutput->execute();

        $allTransactionsOutput = $findTransactionsTypeOutput->fetchAll();
        return $allTransactionsOutput;
    }

}