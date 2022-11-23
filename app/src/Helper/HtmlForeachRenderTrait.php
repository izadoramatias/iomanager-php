<?php

namespace App\Helper;

use App\Model\Services\ValidatesTypeTransaction;

trait HtmlForeachRenderTrait
{
    public static function foreachRender(array $dataRepository): string
    {
        $html = "";
        foreach ($dataRepository as $data) {

            extract($data, EXTR_OVERWRITE);
            $price = number_format($price, 2, ',', '.');
            $transactionType = ValidatesTypeTransaction::validate($type);

            $html .=
                "<section>
                <p class='description'>$description</p>
                <p class='$transactionType'>$price</p>
                <p class='category'>$category</p>
                <p class='date'>$date</p>
                </section>
            ";
        }

        return $html;
    }    
}