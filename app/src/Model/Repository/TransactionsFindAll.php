<?php

namespace App\Model\Repository;


use App\Model\Database\DatabaseConnection;

class TransactionsFindAll
{

    private static ?DatabaseConnection $databaseConnection = null;

    public function __construct()
    {

        self::$databaseConnection = new DatabaseConnection();
        self::$databaseConnection::connect();
    }

    public static function findAll()
    {
        $findAllTransactionsQuery = (self::$databaseConnection::$pdo)->prepare("SELECT * FROM Transactions;");
        $findAllTransactionsQuery->execute();

        $allTransactions = $findAllTransactionsQuery->fetchAll();
        return $allTransactions;
    }

}
