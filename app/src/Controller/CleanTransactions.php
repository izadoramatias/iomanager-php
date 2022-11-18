<?php

namespace App\Controller;

use App\Model\Repository\CleanTransactions as CleanTransactionsRepository;

class CleanTransactions implements InterfaceRequestController
{

    public static function processRequest(): mixed
    {
        new CleanTransactionsRepository();
        CleanTransactionsRepository::clean();

        header('Location: /home');
    }
}