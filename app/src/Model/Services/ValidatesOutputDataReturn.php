<?php

namespace App\Model\Services;

use App\Controller\TransactionsOutput;

abstract class ValidatesOutputDataReturn
{
    public static function validate()
    {
        $output = TransactionsOutput::processRequest();

        if (isset($output)) {
            return $output;
        }
        return 0;
    }
}