<?php

use App\Model\Database\DatabaseCreation;
use App\Model\Database\PDOSingleConnection;
use App\Model\Repository\TransactionRepository;
use App\Model\Storage\TransactionStorage;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TransactionRepositoryTest extends TestCase
{
    public function testInvokeQuantityShouldReturnNullIfCreateInstanceIsNeverCalled(): void
    {
        $PDOSingleConnectionTest = new class extends PDOSingleConnection {
            public static ?int $invokeQuantity = null;

            public static function getPDO($hostName = 'mysql:host=localhost', $username = 'root', $password = '12345'): PDO
            {
                if (is_null(self::$invokeQuantity)){
                    self::createInstancePDO($hostName, $username, $password);
                }
                return new PDO($hostName, $username, $password);
            }

            protected static function createInstancePDO($hostName, $username, $password)
            {
                self::$invokeQuantity = 1;
            }
        };

        $this->assertEquals(null, $PDOSingleConnectionTest::$invokeQuantity);
    }

    public function testInvokeQuantityShouldBeOneWhenCreateInstanceIsCalled(): void
    {
        $PDOSingleConnectionTest = new class extends PDOSingleConnection {
            public static ?int $invokeQuantity = null;

            public static function getPDO($hostName = 'mysql:host=localhost', $username = 'root', $password = '12345'): PDO
            {
                if (is_null(self::$invokeQuantity)){
                    self::createInstancePDO($hostName, $username, $password);
                }
                return new PDO($hostName, $username, $password);
            }

            protected static function createInstancePDO($hostName, $username, $password)
            {
                self::$invokeQuantity = 1;
            }
        };

        $PDOSingleConnectionTest::getPDO();

        $this->assertEquals(1, $PDOSingleConnectionTest::$invokeQuantity);
    }

    public function testShouldThrowAnExceptionWhenAnErrorOccursWhileTryingToConnectToTheDatabase(): void
    {
        $PDOSingleConnectionTest = new class extends PDOSingleConnection {
            public static function getPDO($hostName = 'localhost', $username = 'root', $password = '12345'): PDO
            {
                return throw new PDOException();
            }
        };

        $this->expectException(PDOException::class);

        $PDOSingleConnectionTest::getPDO();
    }

    public function testShouldReturnAPdoObjectWhenCreateDatabaseExecutionReturnAnIntegerGreaterThanOrEqualToZero(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoMock
            ->method('exec')
            ->willReturn(1);

        $db = new DatabaseCreation('iomanager', $pdoMock);

        $this->assertInstanceOf(PDO::class, $db->createDatabase());
    }

    public function testShouldThrowAnExceptionWhenResultOfCreateDatabaseExecutionIsFalse(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoMock
            ->method('exec')
            ->willReturn(false);

        $db = new DatabaseCreation('iomanager', $pdoMock);

        $this->expectException(PDOException::class);

        $db->createDatabase();
    }

    public function testShouldReturnAPdoObjectWhenUseDatabaseExecutionReturnAnIntegerGreaterThanOrEqualToZero(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoMock
            ->method('exec')
            ->willReturn(1);

        $db = new DatabaseCreation('iomanager', $pdoMock);

        $this->assertInstanceOf(PDO::class, $db->useDatabase());
    }

    public function testShoundThrowAnExceptionWhenUseDatabaseIsFalse(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoMock
            ->method('exec')
            ->willReturn(false);

        $db = new DatabaseCreation('iomanager', $pdoMock);

        $this->expectException(PDOException::class);

        $db->useDatabase();
    }

    public function testShouldReturnAPdoObjectIsCreateTableIsSuccessful(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoMock
            ->method('exec')
            ->willReturn(1);

        $db = new DatabaseCreation('iomanager', $pdoMock);

        $this->assertInstanceOf(PDO::class, $db->createTable());
    }

    public function testShouldThrowAnExceptionWhenCreateTableIsFalse(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoMock
            ->method('exec')
            ->willReturn(false);

        $db = new DatabaseCreation('iomanager', $pdoMock);

        $this->expectException(PDOException::class);

        $db->createTable();
    }



    public function testShouldReturnAPricesArrayWhenDatabaseHasInputTransactionsRegistered(): void
    {
        $storage = $this->mockGetTransactions([2,2]);
        $transactionRepository = new TransactionRepository($storage);

        $result = $transactionRepository->getAPriceListOfTransactionsInputType();

        $this->assertEquals([2, 2], $result);
    }

    public function testShouldReturnAnEmptyArrayWhenDatabaseDoesNotHasTransactionsInputRegistered(): void
    {
        $storage = $this->mockGetTransactions([]);
        $transactionRepository = new TransactionRepository($storage);

        $result = $transactionRepository->getAPriceListOfTransactionsInputType();

        $this->assertEquals([], $result);
    }

    public function testeShouldReturnAPriceArrayWhenDatabaseHasOutputTransactionsInputRegistered(): void
    {
        $storage = $this->mockGetTransactions([3, 5]);
        $transactionRepository = new TransactionRepository($storage);

        $result = $transactionRepository->getAPriceListOfTransactionsOutputType();

        $this->assertEquals([3, 5], $result);
    }

    public function testShouldReturnAnEmptyArrayWhenDatabaseDoesNotHasOutputTransactionsRegistered(): void
    {
        $storage = $this->mockGetTransactions([]);
        $transactionRepository = new TransactionRepository($storage);

        $result = $transactionRepository->getAPriceListOfTransactionsOutputType();

        $this->assertEquals([], $result);
    }

    public function testShouldReturnAnArrayOfTransactionsIfExistsDataOnTable(): void
    {
        $storage = $this->mockGetTransactions($this->filledTransactionsList());
        $transactionRepository = new TransactionRepository($storage);

        $result = $transactionRepository->getTransactionsList();

        $this->assertEquals($this->filledTransactionsList(), $result);
    }

    public function testShouldReturnAnEmptyListIfDoesNotHasDataOnTable(): void
    {
        $storage = $this->mockGetTransactions([]);
        $transactionRepository = new TransactionRepository($storage);

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

    private function mockGetTransactions($expectedResult): TransactionStorage|MockObject
    {
        $storageMock = $this->getStorageMock();

//        $storageMock->method('getTransactions')->willReturnCallback(function () use ($expectedResult) {return $expectedResult;});
        $storageMock->method('getTransactions')->willReturn($expectedResult);

        return $storageMock;
    }

    private function getStorageMock(): TransactionStorage|MockObject
    {
        return $this->getMockBuilder(TransactionStorage::class)->disableOriginalConstructor()->getMock();
    }
}