<?php

namespace App\Controller\Pages;

use App\Controller\HtmlController;
use App\Controller\InterfaceRequestController;
use \App\Model\Entity\Transaction;
use App\Controller\Transaction as TransactionController;


class Home extends HtmlController implements InterfaceRequestController {

    private static ?TransactionController $transaction = null;

    public function __construct()
    {
        $this::$transaction = new TransactionController();
    }

    public static function processRequest(): void
    {
        $computer = new Transaction('pc gamer', 5400, 'compra', false);
        $site = new Transaction('desenvolvimento de app', 7900, 'venda', true);
        $design = new Transaction('design cliente', 6600, 'venda', true);

        $requestTemplate = $_SERVER['PATH_INFO']; // pega o recurso pesquisado pelo usuário na uri
        $requestTemplate = str_replace('/', '', $requestTemplate);

        $totalInputs = Transaction::getTotalInputs();
        $totalOutputs = Transaction::getTotalOutputs();
        $total = Transaction::getTotalInputs() - Transaction::getTotalOutputs();


        echo (new Home())->renderHtml(
            "pages/$requestTemplate.php",
            [
                'entrada' => $totalInputs,
                'saida' => $totalOutputs,
                'total' => $total,
                'teste' => self::$transaction::processRequest()
            ]);

    }


}
