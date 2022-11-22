<?php

namespace App\Model\Repository;

use App\Model\Database\DatabaseConnection;
use const App\Model\Database\DB_NAME;

class CleanTransactions
{
    public function __construct()
    {
        (DatabaseConnection::$pdo)->exec('USE ' . DB_NAME . ';');
    }

    public static function clean(): void
    {
        $query = "TRUNCATE TABLE Transactions;";
        (DatabaseConnection::$pdo)->exec($query);
    }
}