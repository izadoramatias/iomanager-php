<?php

namespace App\Model\Database;

use App\Controller\InterfaceRequestController;
use App\Controller\NewTransaction;

class InsertTransaction implements InterfaceRequestController
{

    private static ?DatabaseConnection $databaseConnection = null;
    private static NewTransaction $transaction;

    public function __construct()
    {
        self::$transaction = new NewTransaction();
        self::$databaseConnection = new DatabaseConnection();

        self::$databaseConnection::connect();
    }

    public static function processRequest(): void
    {

        extract(self::$transaction::processRequest(), EXTR_OVERWRITE);

        $insertQuery = "INSERT INTO Transactions (description, price, category, io)
        VALUES ('$description', $price, '$category', false);";

        if ((self::$databaseConnection::$pdo)->query($insertQuery)) {
            echo 'Transação inserida com sucesso!';
            header('Location: /home');
        }



    }
}