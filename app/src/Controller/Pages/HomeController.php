<?php

namespace App\Controller\Pages;

use App\Controller\InterfaceRequestController;
use App\Helper\RenderHome;
use App\Model\Database\PDOSingleConnection;
use App\Model\Repository\TransactionRepository;
use App\Model\Services\HomeService;
use App\Model\Storage\TransactionStorage;

class HomeController implements InterfaceRequestController
{
    public static function processRequest(): void
    {
        $render = new RenderHome();
        $transactionRepository = new TransactionRepository(new TransactionStorage(PDOSingleConnection::getPDO()));
        $transactionService = new HomeService($transactionRepository);

        $homeModel = $transactionService->getHomeModel();

        $html = $render->renderToHtml($homeModel);

        echo $html;
    }
}








