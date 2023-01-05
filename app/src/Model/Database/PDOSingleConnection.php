<?php

namespace App\Model\Database;

use PDO;

class PDOSingleConnection
{
    private PDO|null $pdo = null;
//    private string $hostName = 'localhost';
//    private string $username = 'root';
//    private string $password = '12345';

    public function getPDO($hostName, $username, $password): PDO
    {
        if (is_null($this->pdo)) {
            try {
                $this->pdo = new PDO("mysql:host=$hostName;", $username, $password);
                $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $PDOException) {
                throw new \PDOException($PDOException->getMessage());
            }
        }

        return $this->pdo;
    }
}