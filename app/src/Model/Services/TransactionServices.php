<?php

namespace App\Model\Services;

use App\Model\Repository\TransactionRepository;
use App\Model\TransactionModel;

class TransactionServices
{
    public function __construct(
        public TransactionRepository $transactionRepository
    ) {}

    public function calculateTotalInputTransactions(): float
    {
        $inputs = $this->transactionRepository->getTotalInputTransactions();

        $total = 0;
        foreach ($inputs as $price) {
            $total += $price;
        }

        return $total;
    }

    public function calculateTotalOutputTransactions(): float
    {
        $outputs = $this->transactionRepository->getTotalOutputTransactions();

        $total = 0;
        foreach ($outputs as $price) {
            $total += $price;
        }

        return $total;
    }

    public function convertTransactionsFromArrayToObject(): array
    {
        $arrayTransactions = [];
        $transactions = $this->transactionRepository->getTransactions();
        foreach ($transactions as $transaction) {
            extract($transaction, EXTR_OVERWRITE);

            $transactionToObject = new TransactionModel($description, $price, $category, (new \DateTimeImmutable)::createFromFormat('d/m/Y', $date), $type);
            $arrayTransactions[] = $transactionToObject;
        }

        return $arrayTransactions;
    }
}