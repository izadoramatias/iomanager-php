<?php

namespace App\Controller\Pages;

use App\Controller\InterfaceRequestController;
use App\Helper\RenderHome;
use App\Model\Repository\TransactionRepository;
use App\Model\Services\HomeService;

class HomeController implements InterfaceRequestController
{
    public static function processRequest(): void
    {
        $render = new RenderHome();
        $transactionService = new HomeService(new TransactionRepository());

        $homeModel = $transactionService->getHomeModel();

        $html = $render->renderToHtml($homeModel);

        echo $html;
    }
}








