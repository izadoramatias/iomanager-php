<?php

namespace App\Controller;

use App\Model\Repository\TransactionsFindAll;

class Transaction implements InterfaceRequestController
{
    public static function processRequest(): mixed
    {

        $transactionsRepository = new TransactionsFindAll();
        $all = $transactionsRepository::findAll();

        return $all;
    }
}
