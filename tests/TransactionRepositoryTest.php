<?php

use App\Model\Database\DatabaseConnection;
use App\Model\Database\DatabaseCreation;
use App\Model\Repository\TransactionRepository;
use PHPUnit\Framework\TestCase;

class TransactionRepositoryTest extends TestCase
{
//    public function testConnectionShouldReturnNull(): void
//    {
//        $dbMock = $this->getMockBuilder(DatabaseConnection::class)->getMock();
//
//        $dbMock->method('connect')->willReturn(null);
//
//        $this->assertEquals(null, $dbMock->connect());
//    }

//    public function testSomething(): void
//    {
//        $test = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], '123456');
//
//        var_dump($test);
//
//    }

    public function testShouldReturnAPdoConnectionWhenConnectionIsSucceed(): void
    {
//        $dbMock = $this->getMockBuilder(DatabaseConnection::class)->getMock();
//
//        $dbMock->method('connect')->willReturn(new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']));
//
//        $this->assertEquals(PDO::class, get_class($dbMock->connect($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD'])));

//        $db = new DatabaseConnection();
        $db = new \App\Model\Database\PDOSingleConnection();

        $connection = $db->getPDO('localhost', 'root', '12345');

//        $connection = $db->connect($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);

        $this->assertEquals(PDO::class, get_class($connection));
    }

    public function testConnectionShouldThrowAnExceptionWhenSomeErrorOccurWhenTryingToConnect(): void
    {
//        $dbMock = $this->getMockBuilder(DatabaseConnection::class)->getMock();
//
//        $this->expectException(PDOException::class); // define que está esperando que o código a seguir deverá retornar uma exceção do tipo PDO
//        $dbMock->method('connect')->willReturn(new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], '123456')); // definição que vai fazer o código gerar uma exceção
        $db = new \App\Model\Database\PDOSingleConnection();

        $this->expectException(PDOException::class);

        $db->getPDO('localhost', 'ro', '12345');
    }

    public function testShouldCreateADatabase(): void
    {
//        $dbMock = $this->getMockBuilder(DatabaseCreation::class)->disableOriginalConstructor()->getMock();
//
//        $dbMock->method('createDatabase')->willReturn(0);
//
//        $this->assertTrue($dbMock->createDatabase() > 0 || $dbMock->createDatabase() === 0);
//        $dbConnectionMock = $this->getMockBuilder(DatabaseConnection::class)->getMock();
//        $dbConnectionMock->method('connect')->willReturn(PDO::class)->with('localhost', 'root', '12345');
        $instance = new DatabaseCreation('iomanager', (new \App\Model\Database\PDOSingleConnection())->getPDO('localhost', 'root', '12345'));

        $db = $instance->createDatabase();

        $this->assertEquals(PDO::class, get_class($db));

    }

    public function testShouldCreateDatabaseTable(): void
    {
//        $dbMock = $this->getMockBuilder(DatabaseCreation::class)->disableOriginalConstructor()->getMock();
//
//        $dbMock->method('createTable')->willReturn(0);
//
//        $this->assertTrue($dbMock->createTable() > 0 || $dbMock->createTable() === 0);
        $instance = new DatabaseCreation($GLOBALS['DB_NAME'], (new \App\Model\Database\PDOSingleConnection())->getPDO('localhost', 'root', '12345'));
        $instance->createDatabase();

        $dbTable = $instance->createTable();

        $this->assertEquals(PDO::class, get_class($dbTable));
    }

    public function testDatabaseCreationShouldThrowAnExceptionWhenSomethingInCreationFails(): void
    {
//        $dbMock = $this->getMockBuilder(DatabaseCreation::class)->disableOriginalConstructor()->getMock();
//
//        $dbMock->method('createDatabase')->willReturn(false);
//
//        $this->assertEquals(false, $dbMock->createDatabase());
        $this->expectException(PDOException::class);

        $instance = new DatabaseCreation('iomanager', (new \App\Model\Database\PDOSingleConnection())->getPDO('localhost', 'root', '12345'));
        $instance->createDatabase();
    }

    public function testDatabaseTableCreationShouldThrowAnExceptionWhenSomethingInCreationFails(): void
    {
//        $dbMock = $this->getMockBuilder(DatabaseCreation::class)->disableOriginalConstructor()->getMock();
//
//        $dbMock->method('createTable')->willReturn(false);
//
//        $this->assertEquals(false, $dbMock->createTable());
        $pdoMock = $this->getMockBuilder(\App\Model\Database\PDOSingleConnection::class)->getMock();
        $instance = new DatabaseCreation($GLOBALS['DB_NAME'], $pdoMock->getPDO());

    }

    public function testDatabaseCreatinShoulReturnIntWhenCreationIsSucceeded(): void
    {
        $dbMock = $this->getMockBuilder(DatabaseCreation::class)->disableOriginalConstructor()->getMock();

        $dbMock->method('createDatabase')->willReturn(0);

        $this->assertEquals(0, $dbMock->createDatabase($GLOBALS['DB_NAME']));
    }

    public function testDatabaseTableCreationShouldReturnIntWhenCreationIsSucceeded(): void
    {
        $dbMock = $this->getMockBuilder(DatabaseCreation::class)->disableOriginalConstructor()->getMock();

        $dbMock->method('createTable')->willReturn(1);

        $this->assertEquals(1, $dbMock->createTable());
    }

    public function testWhenDatabaseHasInputTransactionsRegisteredShouldReturnAnArrayWithThemPrice(): void
    {
        // arrange
        $repositoryMock = $this->getMockBuilder(TransactionRepository::class)->getMock();

        // act
        $repositoryMock->method('getAListWithThePricesOfTransactionsTypeInput')->willReturn([2, 2]);

        // assert
        $this->assertEquals([2, 2], $repositoryMock->getAListWithThePricesOfTransactionsTypeInput());
    }

    public function testWhenDatabaseHasNotInputTransactionsRegisteredShouldReturnAnEmptyArray(): void
    {
        // arrange
        $repositoryMock = $this->getMockBuilder(TransactionRepository::class)->getMock();

        // act
        $repositoryMock->method('getAListWithThePricesOfTransactionsTypeInput')->willReturn([]);

        // assert
        $this->assertEquals([], $repositoryMock->getAListWithThePricesOfTransactionsTypeInput());
    }

    public function testWhenDatabaseHasOutputTransactionsRegisteredShouldReturnAnArrayWithThemPrice(): void
    {
        // arrange
        $repositoryMock = $this->getMockBuilder(TransactionRepository::class)->getMock();

        $repositoryMock->method('getAListWithThePricesOfTransactionsTypeOutput')->willReturn([3, 5]);

        $this->assertEquals([3, 5], $repositoryMock->getAListWithThePricesOfTransactionsTypeOutput());
    }

    public function testWhenDatabaseHasNotOutputTransactionsRegisteredShouldReturnAnEmptyArray(): void
    {
        // arrange
        $repositoryMock = $this->getMockBuilder(TransactionRepository::class)->getMock();

        $repositoryMock->method('getAListWithThePricesOfTransactionsTypeOutput')->willReturn([]);

        $this->assertEquals([], $repositoryMock->getAListWithThePricesOfTransactionsTypeOutput());
    }

    public function testShouldReturnATransactionListIfExistsDataOnTable(): void
    {
        $transactionMock = $this->getMockBuilder(TransactionRepository::class)->getMock();

        $transactionMock->method('getAListOfTransactions')->willReturn([
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
        ]);

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
        ], $transactionMock->getAListOfTransactions());
    }

    public function testShouldReturnAnEmptyListIfDoesNotHasDataOnTable(): void
    {
        $repositoryMock = $this->getMockBuilder(TransactionRepository::class)->getMock();

        $repositoryMock->method('getAListOfTransactions')->willReturn([]);

        $this->assertEquals([], $repositoryMock->getAListOfTransactions());
    }
}