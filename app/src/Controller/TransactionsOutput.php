<?php

namespace App\Controller;

use App\Model\Repository\TransactionsTypeOutput;

class TransactionsOutput implements InterfaceRequestController
{

    public static function processRequest(): mixed
    {
        $transactionsOutputRepository = new TransactionsTypeOutput();
        $all = $transactionsOutputRepository->findTransactionsTypeOutput()[0]['totalPriceOutputs'];

        return $all;
    }

}