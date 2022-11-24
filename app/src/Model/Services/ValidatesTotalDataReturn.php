<?php

namespace App\Model\Services;

abstract class ValidatesTotalDataReturn
{
    public static function validate(): float
    {
        $total = CalculateTotalTransactions::calculate();

        if (isset($total)) {
            return $total;
        }
        return 0;
    }
}