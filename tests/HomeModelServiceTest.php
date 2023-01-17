<?php

use App\Model\Repository\TransactionRepository;
use App\Model\Services\HomeService;
use App\Model\TransactionModel;
use PHPUnit\Framework\TestCase;

class HomeModelServiceTest extends TestCase
{
    public function testShouldReturnTheCalculatedSumFromInputTransactions(): void
    {
        // arrange
        $transactionRepository = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        // act
        $transactionRepository
            ->method('getAListWithThePricesOfTransactionsTypeInput')
            ->willReturn([
                0 => 2,
                1 => 2
            ]);
        $homeModelService = new HomeService($transactionRepository);

        // assert
        $this->assertEquals(4, $homeModelService->calculateTotalInputTransactions());
    }

    public function testShouldReturnTheCalculatedSumFromOutputTransactions(): void
    {
        // arrange
        $transactionRepository = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        // act
        $transactionRepository
            ->method('getAListWithThePricesOfTransactionsTypeOutput')
            ->willReturn([
            0 => 3,
            1 => 5
        ]);
        $homeModelService = new HomeService($transactionRepository);

        // assert
        $this->assertEquals(8, $homeModelService->calculateTotalOutputTransactions());
    }

    public function testShouldReturnAnArrayOfObjectsTypeTransactionModel(): void
    {
        // arrange
        $transactionRepository = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        // act
        $transactionRepository
            ->method('getAListOfTransactions')
            ->willReturn([
                0 => [
                    'description' => 'boneco do naruto fazendo rasengan',
                    'price' => 2,
                    'category' => 'decoração',
                    'date' => '12/12/2022',
                    'type' => TransactionModel::TYPE_OUTPUT
                ],
                1 => [
                    'description' => 'patinho de borracha com oculos aviador',
                    'price' => 6,
                    'category' => 'decoração',
                    'date' => '12/12/2022',
                    'type' => TransactionModel::TYPE_OUTPUT
                ],
                2 => [
                    'description' => 'camiseta',
                    'price' => 4,
                    'category' => 'vestuario',
                    'date' => '12/12/2022',
                    'type' => TransactionModel::TYPE_INPUT
                ]
            ]);
        $homeModelService = new HomeService($transactionRepository);

        // assert
        $this->assertContainsOnlyInstancesOf(TransactionModel::class, $homeModelService->convertTransactionsFromArrayToObject());
    }

    public function testShouldReturnAHomeModelWithExpectedValues(): void
    {
        // arrange
        $transactionRepository = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        // act
        $transactionRepository
            ->method('getAListWithThePricesOfTransactionsTypeInput')
            ->willReturn([
                0 => 2,
                1 => 2
            ]);
        $transactionRepository
            ->method('getAListWithThePricesOfTransactionsTypeOutput')
             ->willReturn([
                0 => 3,
                1 => 5
            ]);
        $transactionRepository
            ->method('getAListOfTransactions')
            ->willReturn([
            0 => [
                'description' => 'boneco do naruto fazendo rasengan',
                'price' => 2,
                'category' => 'decoração',
                'date' => '12/12/2022',
                'type' => TransactionModel::TYPE_OUTPUT
            ],
            1 => [
                'description' => 'patinho de borracha com oculos aviador',
                'price' => 6,
                'category' => 'decoração',
                'date' => '12/12/2022',
                'type' => TransactionModel::TYPE_OUTPUT
            ],
            2 => [
                'description' => 'camiseta',
                'price' => 4,
                'category' => 'vestuario',
                'date' => '12/12/2022',
                'type' => TransactionModel::TYPE_INPUT
            ]
        ]);
        $homeModelService = new HomeService($transactionRepository);
        $homeModel = $homeModelService->getHomeModel();

        // assert
        $this->assertEquals(4, $homeModel->totalInputTransactions);
        $this->assertEquals(8, $homeModel->totalOutputTransactions);
        $this->assertEquals(-4, $homeModel->getDiffInputOutputTransactions());
        $this->assertContainsOnlyInstancesOf(TransactionModel::class, $homeModel->getTransactions());
    }
}

