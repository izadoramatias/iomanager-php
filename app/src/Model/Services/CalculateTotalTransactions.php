<?php

namespace App\Model\Services;

use App\Controller\TransactionsInput;
use App\Controller\TransactionsOutput;

abstract class CalculateTotalTransactions
{
    public static function calculate(): float
    {
        $totalInputs = TransactionsInput::processRequest();
        $totalOutputs = TransactionsOutput::processRequest();

        $total = $totalInputs - $totalOutputs;

        return $total;
    }
}