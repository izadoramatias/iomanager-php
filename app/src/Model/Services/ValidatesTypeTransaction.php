<?php

namespace App\Model\Services;

abstract class ValidatesTypeTransaction
{
    public static function validate(int $typeTransaction): string
    {
        return $typeTransaction ? 'price__input' : 'price__output';
    }
}