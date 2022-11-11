<?php

namespace App\Model\Repository;


use App\Model\Database\DatabaseConnection;
use App\Model\Database\DatabaseCreation;

class Transactions
{

    private static DatabaseConnection $connect;
    private static DatabaseCreation $create;

    public function __construct()
    {

        self::$connect = new DatabaseConnection();
        self::$create = new DatabaseCreation();

        self::$connect::connect();
        self::$create::create();
    }

    public static function findAll()
    {

        echo 'teste bd';
    }

}