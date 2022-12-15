<?php

namespace App\Controller;

use App\Model\Repository\InsertTransaction as InsertTransactionRepository;

class InsertTransaction implements InterfaceRequestController
{
    public static function processRequest(): void
    {
        $insertTransactionRepository = new InsertTransactionRepository();
        $insertTransactionRepository::insert();
    }
}