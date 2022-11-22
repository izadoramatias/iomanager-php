<?php

namespace App\Controller\Pages;

use App\Helper\HtmlRenderTrait;
use App\Controller\{
    InterfaceRequestController,
    TransactionsInput,
    TransactionsOutput,
    Transaction as TransactionController};
use App\Model\Services\CalculateTotalTransactions;


class Home implements InterfaceRequestController
{
    use HtmlRenderTrait;
    private static ?TransactionController $transaction = null;

    public function __construct()
    {
        $this::$transaction = new TransactionController();
    }

    public static function processRequest(): mixed
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


