<?php

namespace App\Model\Services;

interface HomeServiceInterface
{
    public function getTotalInputTransactions(): array;
    public function getTotalOutputTransactions(): array;
    public function getTransactions(): array;
}