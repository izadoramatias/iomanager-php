<?php

use App\Model\HomeModel;
use App\Model\TransactionModel;
use PHPUnit\Framework\TestCase;

class HomeModelTest extends TestCase
{
    public function testTotalInputAndTotalOutputShouldBeZeroWhenModelIsCreated(): void
    {
        // arrange
        $homeModel = new HomeModel();

        // act
        $totalInputTransactions = $homeModel->totalInputTransactions;
        $totalOutputTransactions = $homeModel->totalOutputTransactions;

        // assert
        $this->assertEquals(0, $totalInputTransactions);
        $this->assertEquals(0, $totalOutputTransactions);
    }

    public function testTransactionsListShouldBeEmptyWhenModelIsCreated(): void
    {
        // arrange
        $homeModel = new HomeModel();

        // act
        $transactions = $homeModel->getTransactions();

        // assert
        $this->assertEquals([], $transactions);
    }
}