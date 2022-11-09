<?php

namespace App\Controller\Pages;

use App\Controller\InterfaceRequestController;

class NotFound implements InterfaceRequestController
{

    public static function processRequest(): void
    {
        require __DIR__ . '/../../../../resources/view/pages/404.php';
    }
}