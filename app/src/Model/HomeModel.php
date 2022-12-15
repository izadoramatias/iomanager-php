<?php

namespace App\Model;

class HomeModel
{
    public float $totalInputTransactions = 0;
    public float $totalOutputTransactions = 0;
    private array $transactions = [];

    public function addTransaction(TransactionModel $transaction): void
    {
        $this->transactions[] =  $transaction;
    }

    public function addTransactions(array $transactions): void
    {
        foreach ($transactions as $transaction) {
            $this->addTransaction($transaction);
        }
    }

    public function getDiffInputOutputTransactions(): float
    {
        return $this->totalInputTransactions - $this->totalOutputTransactions;
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }
}
