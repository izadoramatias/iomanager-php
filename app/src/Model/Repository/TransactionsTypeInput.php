<?php

namespace App\Model\Repository;

use App\Model\Database\DatabaseConnection;

class TransactionsTypeInput
{
    public function findTransactionsTypeInput()
    {
        $query = "SELECT price FROM Transactions WHERE type = 1;";
        $findTransactionsTypeInput = (DatabaseConnection::$pdo)->prepare($query);
        $findTransactionsTypeInput->execute();

        $allTransactionsInput = $findTransactionsTypeInput->fetchAll();
        return $allTransactionsInput;
    }

}
