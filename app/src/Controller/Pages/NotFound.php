<?php

namespace App\Controller\Pages;

use App\Controller\InterfaceRequestController;
use App\Helper\HtmlRenderTrait;

class NotFound implements InterfaceRequestController
{
    use HtmlRenderTrait;

    public static function processRequest(): mixed
    {
        echo self::renderHtml('/pages/404.php', array());
    }
}