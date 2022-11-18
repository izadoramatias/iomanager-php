<?php

namespace App\Controller;

use App\Model\Repository\TransactionsTypeInput;

class TransactionsInput implements InterfaceRequestController
{

    public static function processRequest(): mixed
    {
        $transactionsInputRepository = new TransactionsTypeInput();
        $all = $transactionsInputRepository->findTransactionsTypeInput()[0]['totalPriceInputs'];

        return $all;
    }

}