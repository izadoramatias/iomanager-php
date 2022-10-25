<?php

namespace Manager\Controllers;

require_once 'autoload.php';

use Manager\Core\Database;
use Manager\Model\Transaction;

class TransactionController extends Database
{

    private Transaction $transaction;

    public function __construct() {}

    public function getPrice(): float
    {
        return $this->transaction->getPrice();
    }

    public static function calculateFinanceTotal(): float
    {
        $inputs = Transaction::getTotalInputs();
        $outputs = Transaction::getTotalOutputs();
        $totalIO = $inputs - $outputs;

        return $totalIO;
    }

    public static function findAllRecords()
    {
        $teste = new Database();
        $sql = "SELECT * FROM Transactions";
        $query = $teste->conn->prepare($sql);
        $query->execute();

        $result = $query->fetchAll();

        return $result;

    }

    public static function createNewTransaction()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            var_dump($_POST);
        }
    }

}

$teste1 = new Transaction('Notebook', 3800, 'Eletrônicos', 1);
$teste2 = new Transaction('Escrivaninha', 920, 'Móveis', false);
$teste3 = new Transaction('Cadeira de escritório', 1600, 'Móveis', false);
$teste5 = new Transaction("TV Full HD 72' Samsung ", 4800, 'Móveis', 0);
$teste4 = new Transaction('Desenvolvimento de site', 8600, 'Venda', true);
echo Transaction::getTotalInputs() . PHP_EOL;
echo Transaction::getTotalOutputs() . PHP_EOL;

echo TransactionController::calculateFinanceTotal() . PHP_EOL;


//$testeDB = new TransactionController();
//$allDataRecords = TransactionController::findAllRecords();

//foreach ($allDataRecords as $record) {
//    var_dump([$record['idTransaction'] => $record['description']]);
//}
//
TransactionController::createNewTransaction() . PHP_EOL;
//$result = $testeDB->insertDataOnTable($teste3);

