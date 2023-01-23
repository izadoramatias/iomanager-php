<?php

use App\Model\Database\DatabaseCreation;
use App\Model\Database\PDOSingleConnection;
use App\Model\Repository\TransactionRepository;
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

    public function testeShouldReturnAPriceArrayWhenDatabaseHasInputTransactionsInputRegistered(): void
    {
        $pdoMock = $this->createPDOMock();
        $this->manipulateReturn([2, 2], $pdoMock);
        $transactionRepository = new TransactionRepository($pdoMock);

        $listWithTransactionsInputPrices = $transactionRepository->getAPriceListOfTransactionsInputType();

        $this->assertEquals([2, 2], $listWithTransactionsInputPrices);
    }

    public function testShouldReturnAnEmptyArrayWhenDatabaseDoesNotHasTransactionsInputRegistered(): void
    {
        $pdoMock = $this->createPDOMock();
        $this->manipulateReturn([], $pdoMock);
        $transactionRepository = new TransactionRepository($pdoMock);

        $listWithTransactionsInputPrices = $transactionRepository->getAPriceListOfTransactionsInputType();

        $this->assertEquals([], $listWithTransactionsInputPrices);
    }

    public function testeShouldReturnAPriceArrayWhenDatabaseHasOutputTransactionsInputRegistered(): void
    {
        $pdoMock = $this->createPDOMock();
        $this->manipulateReturn([3, 5], $pdoMock);
        $transactionRepository = new TransactionRepository($pdoMock);

        $listWithTransactionsOutputPrices = $transactionRepository->getAPriceListOfTransactionsOutputType();

        $this->assertEquals([3, 5], $listWithTransactionsOutputPrices);
    }

    public function testShouldReturnAnEmptyArrayWhenDatabaseDoesNotHasOutputTransactionsRegistered(): void
    {
        $pdoMock = $this->createPDOMock();
        $this->manipulateReturn([], $pdoMock);
        $transactionRepository = new TransactionRepository($pdoMock);

        $listWithTransactionsOutputPrices = $transactionRepository->getAPriceListOfTransactionsOutputType();

        $this->assertEquals([], $listWithTransactionsOutputPrices);
    }

    public function testShouldReturnAnArrayOfTransactionsIfExistsDataOnTable(): void
    {
        $pdoMock = $this->createPDOMock();
        $this->manipulateReturn($this->filledTransactionsList(), $pdoMock);
        $transactionRepository = new TransactionRepository($pdoMock);

        $transactionsList = $transactionRepository->getTransactionsList();

        $this->assertEquals($this->filledTransactionsList(), $transactionsList);
    }

    public function testShouldReturnAnEmptyListIfDoesNotHasDataOnTable(): void
    {
        $pdoMock = $this->createPDOMock();
        $this->manipulateReturn([], $pdoMock);
        $transactionRepository = new TransactionRepository($pdoMock);

        $transactionsList = $transactionRepository->getTransactionsList();

        $this->assertEquals([], $transactionsList);
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

    private function createPDOMock(): PDO|MockObject
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();

        return $pdoMock;
    }

    private function manipulateReturn($return, PDO|MockObject $pdo): void
    {
        $pdoMock = $pdo;
        $pdoStatementMock = $this
            ->getMockBuilder(PDOStatement::class)
            ->getMock();

        $pdoMock->method('query')->willReturn($pdoStatementMock);
        $pdoStatementMock->method('fetchAll')->willReturn($return);
    }
}