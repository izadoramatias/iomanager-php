<?php

namespace App\Model\Services;

use App\Helper\HtmlForeachRenderTrait;
use App\Model\Repository\TransactionsFindAll;

abstract class ValidateIfTransactionsHasData
{
    use HtmlForeachRenderTrait;

    public static function validate(): string
    {
        $transactionsRepository = new TransactionsFindAll();
        $allRepositoryData = $transactionsRepository::findAll();

        if (!empty($allRepositoryData)) {
            return HtmlForeachRenderTrait::foreachRender($allRepositoryData);

        }
        return 'Nenhuma transação cadastrada ):';
    }
}