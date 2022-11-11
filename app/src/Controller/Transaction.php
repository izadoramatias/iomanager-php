<?php

namespace App\Controller;

use App\Model\Repository\Transactions;

class Transaction
{
    public static function processRequest()
    {

        $transactionsRepository = new Transactions();

        $all = $transactionsRepository::findAll();
        return $all;
    }
}