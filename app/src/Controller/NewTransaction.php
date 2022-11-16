<?php

namespace App\Controller;

use \App\Model\Entity\Transaction;

class NewTransaction
{

    public static function processRequest(): array
    {

        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $date = $_POST['date'];
        $type = $_POST['type'];

        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';

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