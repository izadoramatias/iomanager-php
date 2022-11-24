<?php

namespace App\Model\Services;

abstract class ValidatesTotalPositivity
{
    public static function validate(): string
    {
        $total = ValidatesTotalDataReturn::validate();

        if ($total >= 0) {
            return 'positive__credit';
        }
        return 'negative__credit';
    }
}