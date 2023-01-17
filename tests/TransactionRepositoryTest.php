<?php

use App\Model\Database\DatabaseCreation;
use App\Model\Database\PDOSingleConnection;
use App\Model\Repository\TransactionRepository;
use PHPUnit\Framework\TestCase;

class TransactionRepositoryTest extends TestCase
{
    public function testIfCreateInstanceIsNeverCalledInvokeQuantityShouldReturnNull(): void
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

    public function testIfCreateInstanceIsCalledInvokeQuantityShouldBeOne(): void
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

    public function testConnectionShouldThrowAnExceptionWhenSomeErrorOccurWhenTryingToConnect(): void
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

    public function testShouldReturnAPdoObjectIfCreationResultIsSuccessful(): void
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

    public function testShouldThrowAnExceptionWhenCreationResultIsFalse(): void
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

    public function testShouldReturnAPdoObjectIfUseDatabaseIsSuccessful(): void
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

    // testes do repository
    public function testWhenDatabaseHasInputTransactionsRegisteredShouldReturnAnArrayWithThemPrice(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoStatementMock = $this
            ->getMockBuilder(PDOStatement::class)
            ->getMock();

        $pdoMock
            ->method('query')
            ->willReturn($pdoStatementMock);
        $pdoStatementMock
            ->method('fetchAll')
            ->willReturn([2, 2]);

        $transactionRepository = new TransactionRepository($pdoMock);

        $this->assertEquals([2, 2], $transactionRepository->getAListWithThePricesOfTransactionsTypeInput());
    }

    public function testWhenDatabaseHasNotInputTransactionsRegisteredShouldReturnAnEmptyArray(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoStatementMock = $this
            ->getMockBuilder(PDOStatement::class)
            ->getMock();

        $pdoMock
            ->method('query')
            ->willReturn($pdoStatementMock);
        $pdoStatementMock
            ->method('fetchAll')
            ->willReturn([]);

        $transactionRepository = new TransactionRepository($pdoMock);

        $this->assertEquals([], $transactionRepository->getAListWithThePricesOfTransactionsTypeInput());
    }

    public function testWhenDatabaseHasOutputTransactionsRegisteredShouldReturnAnArrayWithThemPrice(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoStatementMock = $this
            ->getMockBuilder(PDOStatement::class)
            ->getMock();

        $pdoMock
            ->method('query')
            ->willReturn($pdoStatementMock);
        $pdoStatementMock
            ->method('fetchAll')
            ->willReturn([3, 5]);

        $transactionRepository = new TransactionRepository($pdoMock);

        $this->assertEquals([3, 5], $transactionRepository->getAListWithThePricesOfTransactionsTypeOutput());
    }

    public function testWhenDatabaseHasNotOutputTransactionsRegisteredShouldReturnAnEmptyArray(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoStatementMock = $this
            ->getMockBuilder(PDOStatement::class)
            ->getMock();

        $pdoMock
            ->method('query')
            ->willReturn($pdoStatementMock);
        $pdoStatementMock
            ->method('fetchAll')
            ->willReturn([]);

        $transactionRepository = new TransactionRepository($pdoMock);

        $this->assertEquals([], $transactionRepository->getAListWithThePricesOfTransactionsTypeOutput());
    }

    public function testShouldReturnATransactionListIfExistsDataOnTable(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoStatementMock = $this
            ->getMockBuilder(PDOStatement::class)
            ->getMock();

        $pdoMock
            ->method('query')
            ->willReturn($pdoStatementMock);
        $pdoStatementMock->method('fetchAll')->willReturn(
            [
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
            ]
        );

        $transactionRepository = new TransactionRepository($pdoMock);

        $this->assertEquals([
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
        ], $transactionRepository->getAListOfTransactions());
    }

    public function testShouldReturnAnEmptyListIfDoesNotHasDataOnTable(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoStatementMock = $this
            ->getMockBuilder(PDOStatement::class)
            ->getMock();

        $pdoMock
            ->method('query')
            ->willReturn($pdoStatementMock);
        $pdoStatementMock
            ->method('fetchAll')
            ->willReturn([]);

        $transactionRepository = new TransactionRepository($pdoMock);

        $this->assertEquals([], $transactionRepository->getAListOfTransactions());
    }
}