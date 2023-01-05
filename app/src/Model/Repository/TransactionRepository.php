<?php

namespace App\Model\Repository;

use App\Model\Database\PDOSingleConnection;
use App\Model\Services\HomeServiceInterface;
use const App\Model\Database\DB_HOST;
use const App\Model\Database\DB_PASS;
use const App\Model\Database\DB_USER;

class TransactionRepository implements HomeServiceInterface
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = (new PDOSingleConnection())->getPDO('localhost', 'root', '12345');
        $this->pdo->exec('USE iomanager;');
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