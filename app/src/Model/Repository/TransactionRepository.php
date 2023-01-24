<?php

namespace App\Model\Repository;

use App\Model\Services\HomeServiceInterface;
use App\Model\Storage\TransactionStorage;

class TransactionRepository implements HomeServiceInterface
{
    private TransactionStorage $storage;

    public function __construct(TransactionStorage $storage)
    {
        $this->storage = $storage;
    }

    public function getAPriceListOfTransactionsInputType(): array
    {
        return $this->storage->getTransactions("SELECT price FROM Transactions WHERE type = 1;");
    }

    public function getAPriceListOfTransactionsOutputType(): array
    {
        return $this->storage->getTransactions("SELECT price FROM Transactions WHERE type = 0;");
    }

    public function getTransactionsList(): array
    {
        return $this->storage->getTransactions("SELECT * FROM Transactions;");
    }
}