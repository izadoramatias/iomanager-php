<?php

use App\Model\Database\DatabaseCreation;
use App\Model\Database\PDOSingleConnection;
use App\Model\Repository\TransactionRepository;
use PHPUnit\Framework\MockObject\Builder\InvocationMocker;
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

            protected static function createInstancePDO($hostName, $username, $password): void
            {
                self::$invokeQuantity = 1;
            }
        };

        $this->assertEquals(null, $PDOSingleConnectionTest::$invokeQuantity);
    }

    public function testInstanceQuantityShouldBeOneWhenCreateInstanceIsCalled(): void
    {
        $PDOSingleConnectionTest = new class extends PDOSingleConnection {
            public static ?int $instancesQuantity = null;

            public static function getPDO($hostName = 'mysql:host=localhost', $username = 'root', $password = 'fulltime12345'): PDO // os parametros e retorno não importam, importa apenas a chamada do método
            {
                if (is_null(self::$instancesQuantity)){
                    self::createInstancePDO($hostName, $username, $password);
                }
                return new PDO($hostName, $username, $password);
            }

            protected static function createInstancePDO($hostName, $username, $password): void
            {
                self::$instancesQuantity++;
            }
        };

        $PDOSingleConnectionTest::getPDO();

        $this->assertEquals(1, $PDOSingleConnectionTest::$instancesQuantity);
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

    public function testShouldReturnAPriceArrayWhenDatabaseHasOutputTransactionsInputRegistered(): void
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