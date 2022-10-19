<?php

namespace Manager\Controllers;

require_once 'autoload.php';
use Manager\Model\Transaction;

class TransactionController
{

    private Transaction $transaction;

    public function __construct(
        Transaction $transaction
    ) {
        $this->transaction = $transaction;

    }
}

$teste1 = new Transaction('Notebook', 3800, 'Eletrônicos', true);
$teste2 = new Transaction('Escrivaninha', 920, 'Móveis', true);
$teste3 = new Transaction('Cadeira de escritório', 1600, 'Móveis', true);
echo Transaction::getTotalInputs() . PHP_EOL;