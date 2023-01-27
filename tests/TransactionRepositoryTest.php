<?php

use App\Model\Database\DatabaseCreation;
use App\Model\Database\PDOSingleConnection;
use App\Model\Repository\TransactionRepository;
use App\Model\Storage\TransactionStorage;
use PHPUnit\Framework\MockObject\Builder\InvocationMocker;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TransactionRepositoryTest extends TestCase
{
    public function testShouldReturnAPricesArrayWhenDatabaseHasInputTransactionsRegistered(): void
    {
        $pdoMock = $this->mocks()['getPdoMock'];

        $storage = $this->mockFetchAll([2,2], $pdoMock);
        $transactionRepository = new TransactionRepository($pdoMock);

        $result = $transactionRepository->getAPriceListOfTransactionsInputType();

        $this->assertEquals([2, 2], $result);
    }

    public function testShouldReturnAnEmptyArrayWhenDatabaseDoesNotHasTransactionsInputRegistered(): void
    {
        $pdoMock = $this->mocks()['getPdoMock'];
        $storage = $this->mockFetchAll([], $pdoMock);
        $transactionRepository = new TransactionRepository($pdoMock);

        $result = $transactionRepository->getAPriceListOfTransactionsInputType();

        $this->assertEquals([], $result);
    }

    public function testeShouldReturnAPriceArrayWhenDatabaseHasOutputTransactionsInputRegistered(): void
    {
        $pdoMock = $this->mocks()['getPdoMock'];
        $storage = $this->mockFetchAll([3, 5], $pdoMock);
        $transactionRepository = new TransactionRepository($pdoMock);

        $result = $transactionRepository->getAPriceListOfTransactionsOutputType();

        $this->assertEquals([3, 5], $result);
    }

    public function testShouldReturnAnEmptyArrayWhenDatabaseDoesNotHasOutputTransactionsRegistered(): void
    {
        $pdoMock = $this->mocks()['getPdoMock'];
        $storage = $this->mockFetchAll([], $pdoMock);
        $transactionRepository = new TransactionRepository($pdoMock);

        $result = $transactionRepository->getAPriceListOfTransactionsOutputType();

        $this->assertEquals([], $result);
    }

    public function testShouldReturnAnArrayOfTransactionsIfExistsDataOnTable(): void
    {
        $pdoMock = $this->mocks()['getPdoMock'];
        $storage = $this->mockFetchAll($this->filledTransactionsList(), $pdoMock);
        $transactionRepository = new TransactionRepository($pdoMock);

        $result = $transactionRepository->getTransactionsList();

        $this->assertEquals($this->filledTransactionsList(), $result);
    }

    public function testShouldReturnAnEmptyListIfDoesNotHasDataOnTable(): void
    {
        $pdoMock = $this->mocks()['getPdoMock'];
        $storage = $this->mockFetchAll([], $pdoMock);
        $transactionRepository = new TransactionRepository($pdoMock);

        $result = $transactionRepository->getTransactionsList();

        $this->assertEquals([], $result);
    }

    private function filledTransactionsList(): array
    {
        return [
            0 => [
                'description' => 'abc',
                'price' => 2,
                'category' => 'nenhuma',
                'date' => '12/12/2012',
                'type' => 1
            ],
            2 => [
                'description' => 'def',
                'price' => 8,
                'category' => 'nenhuma',
                'date' => '26/12/2012',
                'type' => 0
            ]
        ];
    }

    private function mockFetchAll($expectedResult, $pdoMock): InvocationMocker
    {
        $pdoStatementMock = $this->mocks()['getPdoStatementMock'];
        $pdoMock->method('query')->willReturn($pdoStatementMock);

//        $storageMock->method('getTransactions')->willReturnCallback(function () use ($expectedResult) {return $expectedResult;});

        return $pdoStatementMock->method('fetchAll')->willReturn($expectedResult);
    }

    private function mocks(): array
    {
        return [
            'getPdoMock' => $this->getMockBuilder(PDO::class)->disableOriginalConstructor()->getMock(),
            'getPdoStatementMock' => $this->getMockBuilder(PDOStatement::class)->getMock()
        ];
    }

}