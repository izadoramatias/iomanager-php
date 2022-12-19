<?php

namespace App\Model\Services;

interface HomeService
{
    public function getTotalInputTransactions(): array;
    public function getTotalOutputTransactions(): array;
    public function getTransactions(): array;
}