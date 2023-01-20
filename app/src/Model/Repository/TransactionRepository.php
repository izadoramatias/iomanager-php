<?php

namespace App\Model\Repository;

use App\Model\Database\PDOSingleConnection;
use App\Model\Services\HomeServiceInterface;
use PDOStatement;

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
        $inputTransactionsList = $this->getTransactions(
            "SELECT price FROM Transactions WHERE type = 1;");

        return $inputTransactionsList;
    }

    public function getAListWithThePricesOfTransactionsTypeOutput(): array
    {
        $outputTransactionsList = $this->getTransactions("SELECT price FROM Transactions WHERE type = 0;");

        return $outputTransactionsList;
    }

    public function getAListOfTransactions(): array
    {
        $transactionsList = $this->getTransactions("SELECT * FROM Transactions;");

        return $transactionsList;
    }

    private function getTransactions(string $statement): array|false
    {
        $createStatement = $this->pdo->query($statement);

        $fetchAll = $createStatement->fetchAll(\PDO::FETCH_ASSOC);

        return $fetchAll;
    }
}