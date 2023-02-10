<?php

namespace App\Model\Repository;

use App\Model\Services\HomeServiceInterface;

class TransactionRepository implements HomeServiceInterface
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getTransactions(string $statement): array|false
    {
        $createStatement = $this->pdo->query($statement);

        return $createStatement->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAPriceListOfTransactionsInputType(): array
    {
        return $this->getTransactions("SELECT price FROM Transactions WHERE type = 1;");
    }

    public function getAPriceListOfTransactionsOutputType(): array
    {
        return $this->getTransactions("SELECT price FROM Transactions WHERE type = 0;");
    }

    public function getTransactionsList(): array
    {
        return $this->getTransactions("SELECT * FROM Transactions;");
    }
}