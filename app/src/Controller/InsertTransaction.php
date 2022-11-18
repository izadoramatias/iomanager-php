<?php

namespace App\Controller;

use App\Model\Database\InsertTransaction as InsertTransactionRepository;

class InsertTransaction implements InterfaceRequestController
{

    public static function processRequest(): mixed
    {
        new InsertTransactionRepository();
        InsertTransactionRepository::insert();
    }
}