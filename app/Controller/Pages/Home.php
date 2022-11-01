<?php

namespace App\Controller\Pages;

use App\MySql;
use \App\Utils\View;
use \App\Model\Entity\Transaction;

class Home {

    public static function getHome(): string
    {
        $computer = new Transaction('pc gamer', 5400, 'compra', false);
        $site = new Transaction('desenvolvimento de app', 7900, 'venda', true);
        $design = new Transaction('design cliente', 6600, 'venda', true);

        $requestTemplate = $_SERVER['REQUEST_URI']; // pega o recurso pesquisado pelo usuário na uri

        MySql::connect();

        return View::render("pages/$requestTemplate", [
            'entradas' => Transaction::getTotalInputs(),
            'saidas' => Transaction::getTotalOutputs(),
            'total' => Transaction::getTotalInputs() - Transaction::getTotalOutputs()
        ]);
    }
}
