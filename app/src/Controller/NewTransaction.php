<?php

namespace App\Controller;

class NewTransaction
{

    public static function processRequest(): array
    {

        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $date = $_POST['date'];
        $type = $_POST['type'];

        return [
            'description' => $description,
            'price' => $price,
            'category' => $category,
            'date' => $date,
            'type' => $type
        ];
    }
}