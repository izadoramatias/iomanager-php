<?php

use App\Model\Repository\TransactionRepository;
use App\Model\Services\HomeService;
use App\Model\TransactionModel;
use PHPUnit\Framework\TestCase;

class HomeServiceTest extends TestCase
{
    public function testShouldReturnTheCalculatedSumFromInputTransactions(): void
    {
        $transactionRepositoryMock = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock(); // dummy
        $inputTransactionsList = [
            ['price' => 2,],
            ['price' => 2.5]
        ];

        $homeService = new HomeService($transactionRepositoryMock);
        $transactionsSum = $homeService->calculateTotalInputTransactions($inputTransactionsList);

        $this->assertEquals(4.5, $transactionsSum);
    }

    public function testShouldReturnTheCalculatedSumFromOutputTransactions(): void
    {
        $transactionRepositoryMock = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $outputTransactionsList = [
            ['price' => 3],
            ['price' => 5.5]
        ];

        $homeService = new HomeService($transactionRepositoryMock);
        $transactionsSum = $homeService->calculateTotalOutputTransactions($outputTransactionsList);

        $this->assertEquals(8.5, $transactionsSum);
    }

    public function testShouldConvertAnArrayOfArraysToAnArrayOfObjectsTypeTransaction(): void
    {
        $transactionRepository = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $homeModelService = new HomeService($transactionRepository);

        $filledTransactionsList = $this->filledTransactionsList();
        $transactionsObjectList = $homeModelService
            ->convertTransactionsFromArrayToObject($filledTransactionsList);

        $this->assertContainsOnlyInstancesOf(TransactionModel::class, $transactionsObjectList);
    }

    public function testShouldReturnAHomeModelWithExpectedValues(): void
    {
        $transactionRepositoryMock = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $transactionRepositoryMock
            ->method('getAPriceListOfTransactionsInputType')
            ->willReturn([
                ['price' => 2],
                ['price' => 2]
            ]);
        $transactionRepositoryMock
            ->method('getAPriceListOfTransactionsOutputType')
             ->willReturn([
                 ['price' => 3],
                 ['price' => 5]
             ]);
        $transactionRepositoryMock
            ->method('getTransactionsList')
            ->willReturn($this->filledTransactionsList());

        $homeModelService = new HomeService($transactionRepositoryMock);
        $getHomeModel = $homeModelService->getHomeModel();

        $this->assertEquals(4, $getHomeModel->totalInputTransactions);
        $this->assertEquals(8, $getHomeModel->totalOutputTransactions);
        $this->assertEquals(-4, $getHomeModel->getDiffInputOutputTransactions()); // testar ou não se a diferença está sendo calculada corretamente? pq não é uma responsabilidade do service calcular a diferença, mas é consequencia de uma ação feita no service, e que afetará a HomeModel que está sendo retornada pelo getHomeModel
        $this->assertContainsOnlyInstancesOf(TransactionModel::class, $getHomeModel->getTransactions());
    }

    private function filledTransactionsList(): array
    {
        $transactionsList = [
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
        ];

        return $transactionsList;
    }
}

