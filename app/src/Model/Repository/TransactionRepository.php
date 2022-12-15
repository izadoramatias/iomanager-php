<?php

namespace App\Model\Repository;

use App\Model\TransactionModel;

class TransactionRepository
{
    public function getTotalInputTransactions(): float
    {
        return 0;
    }

    public function getTotalOutputTransactions(): float
    {
        return 1.99;
    }

    public function getTransactions(): array
    {
        return [
            new TransactionModel('batata', 1.99, 'alimentação', new \DateTimeImmutable('4 days ago'), 0)
        ];
    }
}