<?php

namespace App\Helper;

trait HtmlRenderTrait
{
    public static function renderHtml(string $templatePath, array $data): string
    {

        extract($data, EXTR_OVERWRITE);

        ob_start();
        require  __DIR__ . '/../View/' . $templatePath;
        $html = ob_get_clean();

        return $html;
    }
}