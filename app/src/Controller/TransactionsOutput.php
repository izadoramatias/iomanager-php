<?php

namespace App\Controller;

use App\Model\Repository\TransactionsTypeOutput;

class TransactionsOutput
{

    public static function processRequest(): float|null
    {
        $transactionsOutputRepository = new TransactionsTypeOutput();
        $all = $transactionsOutputRepository->findTransactionsTypeOutput()[0]['totalPriceOutputs'];

        return $all;
    }

}