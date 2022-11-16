<?php

namespace App\Controller\Pages;

use App\Controller\{HtmlController,
    InterfaceRequestController,
    TransactionsInput,
    TransactionsOutput,
    Transaction as TransactionController};
use App\Model\Database\DatabaseCreation;
use App\Model\Services\CalculateTotalTransactions;


class Home extends HtmlController implements InterfaceRequestController {

    private static ?TransactionController $transaction = null;
    private static ?DatabaseCreation $databaseCreation = null;

    public function __construct()
    {
        $this::$transaction = new TransactionController();

        self::$databaseCreation = new DatabaseCreation();
        self::$databaseCreation::create();

    }

    public static function processRequest(): void
    {
        $requestTemplate = $_SERVER['PATH_INFO']; // pega o recurso pesquisado pelo usuário na uri
        $requestTemplate = str_replace('/', '', $requestTemplate);

        $entrada = TransactionsInput::processRequest();
        $saida = TransactionsOutput::processRequest();
        $total = CalculateTotalTransactions::calculate();

        echo self::renderHtml(
            "pages/$requestTemplate.php",
            [
                'entrada' => number_format($entrada, 2, ',', '.'),
                'saida' => number_format($saida, 2, ',', '.'),
                'total' => number_format($total, 2, ',', '.'),
                'transacoes' => self::$transaction::processRequest()
            ]);

    }

}


