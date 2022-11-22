<?php

namespace App\Controller;

use App\Model\Entity\Transaction;

class NewTransaction implements InterfaceRequestController
{

    public static function processRequest(): mixed
    {
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
        $type = filter_input(INPUT_POST, 'type', FILTER_VALIDATE_INT);

        new Transaction($description, $price, $category, $date, $type);

        return [
            'description' => $description,
            'price' => $price,
            'category' => $category,
            'date' => $date,
            'type' => $type
        ];
    }
}