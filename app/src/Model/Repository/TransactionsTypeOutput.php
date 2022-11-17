<?php

namespace App\Model\Repository;

use App\Model\Database\DatabaseConnection;

class TransactionsTypeOutput
{

    public function findTransactionsTypeOutput()
    {

        $query = "SELECT SUM(price) AS 'totalPriceOutputs' FROM Transactions WHERE type = 0;";
        $findTransactionsTypeOutput = (DatabaseConnection::$pdo)->prepare($query);
        $findTransactionsTypeOutput->execute();

        $allTransactionsOutput = $findTransactionsTypeOutput->fetchAll();
        return $allTransactionsOutput;
    }

}