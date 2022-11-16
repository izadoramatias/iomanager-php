<?php

use App\Controller\Pages\Home;
use App\Model\Database\InsertTransaction;
use App\Controller\CleanTransactions;

return [
    '/home' => Home::class,
    '/new-transaction' => InsertTransaction::class,
    '/clean-transactions' => CleanTransactions::class
];
