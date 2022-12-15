<?php

namespace App\Helper;

use App\Model\HomeModel;
use App\Model\TransactionModel;

class RenderHome
{
    public function renderToHtml(HomeModel $home): string
    {
        $transactionHtml = '';
        foreach ($home->getTransactions() as $transaction){
            $transactionHtml .= $this->renderTransactionToHtml($transaction);
        }

        extract([
            'input' => number_format($home->totalInputTransactions, 2, ',', '.'),
            'output' => number_format($home->totalOutputTransactions, 2, ',', '.'),
            'total' => number_format($home->getDiffInputOutputTransactions(), 2, ',', '.'),
            'positivity' => $home->getDiffInputOutputTransactions() >= 0,
            'transactions' => $transactionHtml
        ], EXTR_OVERWRITE);

        ob_start();
        require  __DIR__ . '/../View/pages/home.php';
        $html = ob_get_clean();

        return $html;
    }

    private function renderTransactionToHtml(TransactionModel $transactionModel): string
    {
        $html = "";
        $price = number_format($transactionModel->price, 2, ',', '.');
        $transactionType = $transactionModel->isInputType() ? 'price__input' : 'price__output';
        $formattedDate = $transactionModel->date->format('d/m/Y');
        $html .=
            "<section>
            <p class='description'>$transactionModel->description</p>
            <p class='price $transactionType'>$price</p>
            <p class='category'>$transactionModel->category</p>
            <p class='date'>$formattedDate</p>
            </section>

        ";

        return $html;
    }
}