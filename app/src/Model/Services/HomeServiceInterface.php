<?php

namespace App\Model\Services;

interface HomeServiceInterface
{
    public function getAPriceListOfTransactionsInputType(): array;
    public function getAPriceListOfTransactionsOutputType(): array;
    public function getTransactionsList(): array;
}