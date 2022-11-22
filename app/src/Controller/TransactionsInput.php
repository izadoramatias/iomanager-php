<?php

namespace App\Controller;

use App\Model\Repository\TransactionsTypeInput;

class TransactionsInput implements InterfaceRequestController
{

    public static function processRequest(): float|null
    {
        $transactionsInputRepository = new TransactionsTypeInput();
        $all = $transactionsInputRepository->findTransactionsTypeInput()[0]['totalPriceInputs'];

        return $all;
    }

}