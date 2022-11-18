<?php

namespace App\Controller\Pages;

use App\Controller\HtmlController;
use App\Controller\InterfaceRequestController;

class NotFound extends HtmlController implements InterfaceRequestController
{

    public static function processRequest(): mixed
    {
        echo self::renderHtml('/pages/404.php', array());
    }
}