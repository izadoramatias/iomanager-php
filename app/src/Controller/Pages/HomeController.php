<?php

namespace App\Controller\Pages;

//require_once __DIR__ . '/../../../../vendor/autoload.php';

/*use App\Helper\HtmlRenderTrait;
use App\Model\Services\{ValidateIfTransactionsHasData,
    ValidatesInputDataReturn,
    ValidatesOutputDataReturn,
    CalculateTotalTransactions,
    ValidatesTotalDataReturn,
    ValidatesTotalPositivity};
use App\Controller\{
    InterfaceRequestController,
    Transaction as TransactionController};*/

use App\Controller\InterfaceRequestController;
use App\Controller\NewTransaction;
use App\Helper\RenderHome;
use App\Model\HomeModel;
use App\Model\Repository\TransactionRepository;
use App\Model\TransactionModel;

class HomeController implements InterfaceRequestController
{
    public static function processRequest(): void
    {
        $homeModel = new HomeModel();
        $render = new RenderHome();
        $transactionRepository = new TransactionRepository();

        $homeModel->totalInputTransactions = $transactionRepository->getTotalInputTransactions();
        $homeModel->totalOutputTransactions = $transactionRepository->getTotalOutputTransactions();
        $homeModel->addTransactions($transactionRepository->getTransactions());

        $homeModel = $render->renderToHtml($homeModel);
        echo $homeModel;
    }

//    use HtmlRenderTrait;
//    private static ?TransactionController $transaction = null;

//    public function __construct()
//    {
//        $this::$transaction = new TransactionController();
//    }
//
//    public static function processRequest(): void
//    {
//        $homeModel = new HomeModel();
//        $render = new RenderHome();
//        $transactionRepository = new TransactionRepository();
//
//        $homeModel->totalInputTransactions = $transactionRepository->getTotalInputTransactions();
//        $homeModel->totalOutputTransactions = $transactionRepository->getTotalOutputTransactions();
//        $homeModel->addTransactions($transactionRepository->getTransactions());
//
//
//        $homeHtml = $render->renderToHtml($homeModel);
//
//        echo $homeHtml;
}








