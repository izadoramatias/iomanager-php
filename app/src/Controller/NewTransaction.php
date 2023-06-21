<?php

namespace App\Controller;

use App\Model\HomeModel;
use App\Model\TransactionModel;

class NewTransaction
{
    public static function processRequest(): TransactionModel
    {
        $description = filter_input(INPUT_POST, 'description');
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $category = filter_input(INPUT_POST, 'category');
        $date = \DateTimeImmutable::createFromFormat('Y-m-d', filter_input(INPUT_POST, 'date'));
        $type = filter_input(INPUT_POST, 'type', FILTER_VALIDATE_INT);

        $transactionModel = new TransactionModel(description: htmlspecialchars($description), price: $price, category: htmlspecialchars($category), date: $date, type: $type);
        return $transactionModel;
    }
}