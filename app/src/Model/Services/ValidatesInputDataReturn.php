<?php

namespace App\Model\Services;

use App\Controller\TransactionsInput;

abstract class ValidatesInputDataReturn
{
    public static function validate()
    {
        $input = TransactionsInput::processRequest();

        if (isset($input)) {
            return $input;
        }
        return 0;
    }
}