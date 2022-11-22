<?php

namespace App\Controller;

use App\Model\Repository\CleanTransactions as CleanTransactionsRepository;

class CleanTransactions
{
    public static function processRequest(): void
    {
        $cleanTransactionsRepository = new CleanTransactionsRepository();
        $cleanTransactionsRepository::clean();

        header('Location: /home');
    }
}