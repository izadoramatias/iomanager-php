<?php

use App\Controller\InsertTransaction;
use App\Controller\CleanTransactions;
use App\Controller\Pages\HomeController;

return [
    '/home' => HomeController::class,
    '/new-transaction' => InsertTransaction::class,
    '/clean-transactions' => CleanTransactions::class
];
