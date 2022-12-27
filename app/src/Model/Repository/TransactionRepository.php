<?php

namespace App\Model\Repository;

use App\Model\Database\DatabaseConnection;
use App\Model\Services\HomeServiceInterface;

class TransactionRepository implements HomeServiceInterface
{
    public function getAListWithThePricesOfTransactionsTypeInput(): array
    {
        $query = "SELECT price FROM Transactions WHERE type = 1;";
        $findTransactionsTypeInput = (DatabaseConnection::$pdo)->query($query);

        $fetchTransactions = $findTransactionsTypeInput->fetchAll(DatabaseConnection::$pdo::FETCH_COLUMN);

        return $fetchTransactions;
    }

    public function getAListWithThePricesOfTransactionsTypeOutput(): array
    {
        $query = "SELECT price FROM Transactions WHERE type = 0;";
        $findTransactionsTypeOutput = (DatabaseConnection::$pdo)->query($query);

        $fetchTransactions = $findTransactionsTypeOutput->fetchAll(DatabaseConnection::$pdo::FETCH_COLUMN);

        return $fetchTransactions;
    }

    public function getAListOfTransactions(): array
    {
        $getTransactions = (DatabaseConnection::$pdo)->query("SELECT * FROM Transactions;");

        $fetchAll = $getTransactions->fetchAll(DatabaseConnection::$pdo::FETCH_ASSOC);

        return $fetchAll;
    }
}