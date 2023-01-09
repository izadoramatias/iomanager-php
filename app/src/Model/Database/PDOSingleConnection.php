<?php

namespace App\Model\Database;

use PDO;

class PDOSingleConnection
{
    private PDO|null $pdo = null;

    public function getPDO(
        $hostName = 'localhost',
        $username = 'root',
        $password = '12345'
    ): PDO
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