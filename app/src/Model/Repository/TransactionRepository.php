<?php

namespace App\Model\Repository;

use App\Model\Database\PDOSingleConnection;
use App\Model\Services\HomeServiceInterface;

class TransactionRepository implements HomeServiceInterface
{
    private \PDO $pdo;
    public function __construct(
        \PDO $pdo
    ){
        $this->pdo = $pdo;
    }

    public function getAListWithThePricesOfTransactionsTypeInput(): array
    {
        $query = "SELECT price FROM Transactions WHERE type = 1;";
        $findTransactionsTypeInput = $this->pdo->query($query);

        $fetchTransactions = $findTransactionsTypeInput->fetchAll($this->pdo::FETCH_COLUMN);

        return $fetchTransactions;
    }

    public function getAListWithThePricesOfTransactionsTypeOutput(): array
    {
        $query = "SELECT price FROM Transactions WHERE type = 0;";
        $findTransactionsTypeOutput = $this->pdo->query($query);

        $fetchTransactions = $findTransactionsTypeOutput->fetchAll($this->pdo::FETCH_COLUMN);

        return $fetchTransactions;
    }

    public function getAListOfTransactions(): array
    {
        $getTransactions = $this->pdo->query("SELECT * FROM Transactions;");

        $fetchAll = $getTransactions->fetchAll($this->pdo::FETCH_ASSOC);

        return $fetchAll;
    }
}