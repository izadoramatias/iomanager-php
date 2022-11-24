<?php

namespace App\Controller\Pages;

use App\Helper\HtmlRenderTrait;
use App\Model\Services\{ValidateIfTransactionsHasData,
    ValidatesInputDataReturn,
    ValidatesOutputDataReturn,
    CalculateTotalTransactions,
    ValidatesTotalDataReturn,
    ValidatesTotalPositivity};
use App\Controller\{
    InterfaceRequestController,
    Transaction as TransactionController};


class Home implements InterfaceRequestController
{
    use HtmlRenderTrait;
    private static ?TransactionController $transaction = null;

    public function __construct()
    {
        $this::$transaction = new TransactionController();
    }

    public static function processRequest(): void
    {
        $requestTemplate = $_SERVER['PATH_INFO']; // pega o recurso pesquisado pelo usuário na uri
        $requestTemplate = str_replace('/', '', $requestTemplate);

        $input = ValidatesInputDataReturn::validate();
        $output = ValidatesOutputDataReturn::validate();
        $total = ValidatesTotalDataReturn::validate();

        echo self::renderHtml(
            "pages/$requestTemplate.php",
            [
                'input' => number_format($input, 2, ',', '.'),
                'output' => number_format($output, 2, ',', '.'),
                'total' => number_format($total, 2, ',', '.'),
                'positivity' => ValidatesTotalPositivity::validate(),
                'transactions' => ValidateIfTransactionsHasData::validate()
            ]);
    }
}


