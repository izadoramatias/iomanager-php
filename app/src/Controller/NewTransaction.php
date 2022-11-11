<?php

namespace App\Controller;

class NewTransaction
{

    public static function processRequest(): array
    {

        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        return [
            'description' => $description,
            'price' => $price,
            'category' => $category
        ];
    }
}