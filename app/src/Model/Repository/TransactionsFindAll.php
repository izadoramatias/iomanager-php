<?php

namespace App\Model\Repository;


use App\Model\Database\DatabaseConnection;

class TransactionsFindAll
{

    public static function findAll()
    {
        $findAllTransactionsQuery = (DatabaseConnection::$pdo)->query("SELECT * FROM Transactions;");

        $allTransactions = $findAllTransactionsQuery->fetchAll();
        return $allTransactions;
    }

}
