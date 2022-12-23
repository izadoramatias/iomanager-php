<?php

namespace App\Model\Services;

interface HomeServiceInterface
{
    public function getAListWithThePricesOfTransactionsTypeInput(): array;
    public function getAListWithThePricesOfTransactionsTypeOutput(): array;
    public function getAListOfTransactions(): array;
}