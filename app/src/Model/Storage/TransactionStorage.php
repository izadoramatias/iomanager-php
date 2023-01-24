<?php

namespace App\Model\Storage;

class TransactionStorage
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getTransactions(string $statement): array|false
    {
        $createStatement = $this->pdo->query($statement);

        return $createStatement->fetchAll(\PDO::FETCH_ASSOC);
    }
}