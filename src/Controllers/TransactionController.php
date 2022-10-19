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

    public static function calculateFinanceTotal(): float
    {
        $inputs = Transaction::getTotalInputs();
        $outputs = Transaction::getTotalOutputs();
        $totalIO = $inputs - $outputs;

        return $totalIO;
    }
}

$teste1 = new Transaction('Notebook', 3800, 'Eletrônicos', false);
$teste2 = new Transaction('Escrivaninha', 920, 'Móveis', false);
$teste3 = new Transaction('Cadeira de escritório', 1600, 'Móveis', false);
$teste5 = new Transaction("TV Full HD 72' Samsung ", 4800, 'Móveis', false);
$teste4 = new Transaction('Desenvolvimento de site', 8600, 'Venda', true);
echo Transaction::getTotalInputs() . PHP_EOL;
echo Transaction::getTotalOutputs() . PHP_EOL;

echo TransactionController::calculateFinanceTotal() . PHP_EOL;