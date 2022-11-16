<?php

namespace App\Model\Repository;

use App\Model\Database\DatabaseConnection;
use const App\Model\Database\DB_NAME;

class CleanTransactions
{

    private static ?DatabaseConnection $databaseConnection = null;

    public function __construct()
    {

        self::$databaseConnection = new DatabaseConnection();
        self::$databaseConnection::connect();

        (self::$databaseConnection::$pdo)->exec('USE ' . DB_NAME . ';');
    }

    public static function clean(): void
    {
        $query = "TRUNCATE TABLE Transactions;";
        (self::$databaseConnection::$pdo)->exec($query);
    }
}