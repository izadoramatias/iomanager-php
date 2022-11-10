<?php

namespace App\Model\Repository;


use App\Model\Database\DatabaseConnection;
use App\Model\Database\DatabaseCreation;

class Transactions
{

    public function __construct()
    {

        DatabaseConnection::connect();
        DatabaseCreation::create();
    }

    public static function findAll()
    {

        echo 'teste bd';
    }

}