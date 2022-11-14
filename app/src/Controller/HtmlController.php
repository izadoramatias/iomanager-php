<?php

namespace App\Controller;

abstract class HtmlController
{

    public function renderHtml(string $templatePath, array $data): string
    {
//        echo "<pre>";
//        var_dump(\App\Model\Entity\Transaction::setTotalInputs(1000));
//        echo "</pre>";

        extract($data, EXTR_OVERWRITE);

        ob_start();
        require  __DIR__ . '/../../../resources/view/' . $templatePath;
        $html = ob_get_clean();

        return $html;
    }

}