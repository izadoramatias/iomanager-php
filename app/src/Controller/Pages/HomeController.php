<?php

namespace App\Controller\Pages;

use App\Controller\InterfaceRequestController;
use App\Helper\RenderHome;
use App\Model\HomeModel;
use App\Model\Repository\TransactionRepository;
use App\Model\Services\TransactionServices;

class HomeController implements InterfaceRequestController
{
    public static function processRequest(): void
    {
        $homeModel = new HomeModel();
        $render = new RenderHome();
        $transactionService = new TransactionServices(new TransactionRepository());

        $homeModel->totalInputTransactions = $transactionService->calculateTotalInputTransactions();
        $homeModel->totalOutputTransactions = $transactionService->calculateTotalOutputTransactions();
        $homeModel->addTransactions($transactionService->convertTransactionsFromArrayToObject());

        $html = $render->renderToHtml($homeModel);
        echo $html;
    }
}








