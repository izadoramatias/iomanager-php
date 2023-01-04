<?php

use App\Model\Database\DatabaseConnection;
use App\Model\Database\DatabaseCreation;
use App\Model\Repository\TransactionRepository;
use PHPUnit\Framework\TestCase;

class TransactionRepositoryTest extends TestCase
{
    public function testConnectionShouldReturnNull(): void
    {
        $pdoMock = $this->getMockBuilder(DatabaseConnection::class)->getMock();

        $pdoMock->method('connect')->willReturn(null);

        $this->assertEquals(null, $pdoMock->connect());
    }

    public function testShouldReturnAPdoConnection(): void
    {
        return;
    }

    public function testConnectionShouldThrowAnExceptionWhenSomeErrorOccurWhenTryingToConnect(): void
    {
        $pdoMock = $this->getMockBuilder(DatabaseConnection::class)->getMock();

        $this->expectException(Exception::class); // define que está esperando que o código a seguir deverá retornar uma exceção
        $pdoMock->method('connect')->willReturn(new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD'])); // definição que vai fazer o código gerar uma exceção
    }

    public function testShouldCreateADatabase(): void
    {
//        $pdoMock = $this->getMockBuilder(PDO::class)->disableOriginalConstructor()
//            ->getMock();
//
//        $pdoMock->method('exec')->willReturn(0);
//
//        $this->assertTrue($pdoMock->exec('CREATE DATABASE iomanager;') > 0 || $pdoMock->exec('CREATE DATABASE iomanager;') === 0);

        $dbMock = $this->getMockBuilder(DatabaseCreation::class)->disableOriginalConstructor()->getMock();

        $dbMock->method('createDatabase')->willReturn(0);

        $this->assertTrue($dbMock->createDatabase() > 0 || $dbMock->createDatabase() === 0);
    }

    public function testShouldCreateDatabaseTable(): void
    {
//        $pdoMock = $this->getMockBuilder(
//            PDO::class)
//            ->disableOriginalConstructor()
//            ->getMock();
//
//        $pdoMock->method('exec')->willReturn(0); // refatorar pq não está intuitivo e fácil de ler
//
//        $statement = "CREATE TABLE IF NOT EXISTS                         Transactions(
//                                idTransaction int NOT NULL PRIMARY KEY AUTO_INCREMENT,
//                                description varchar(255) NOT NULL,
//                                price float NOT NULL,
//                                category varchar(45) NOT NULL,
//                                date varchar(10) NOT NULL,
//                                type TINYINT NOT NULL);";
//        $this->assertTrue($pdoMock->exec($statement) > 0 || $pdoMock->exec($statement) === 0);
        $dbMock = $this->getMockBuilder(DatabaseCreation::class)->disableOriginalConstructor()->getMock();

        $dbMock->method('createTable')->willReturn(0);

        $this->assertTrue($dbMock->createTable() > 0 || $dbMock->createTable() === 0);
    }
//
//    public function testDatabaseCreationShouldThrowAnExceptionWhenSomethingInCreationFails(): void
//    {
//        $pdoMock = $this->getMockBuilder(DatabaseCreation::class)->disableOriginalConstructor()->getMock();
//
//        $this->expectException(InvalidArgumentException::class);
//
////        $pdoMock->method('create')->willThrowException(throw new InvalidArgumentException());
//        $pdoMock->method('createDatabase')->willReturn(false);
//    }

    public function testDatabaseCreationShouldReturnFalseWhenSomethingInCreationFails(): void
    {
        $dbMock = $this->getMockBuilder(DatabaseCreation::class)->disableOriginalConstructor()->getMock();

        $dbMock->method('createDatabase')->willReturn(false);

        $this->assertEquals(false, $dbMock->createDatabase());
    }

    public function testDatabaseTableCreationShouldReturnFalseWhenSomethingInCreationFails(): void
    {
        $dbMock = $this->getMockBuilder(DatabaseCreation::class)->disableOriginalConstructor()->getMock();

        $dbMock->method('createTable')->willReturn(false);

        $this->assertEquals(false, $dbMock->createTable());
    }

    public function testDatabaseCreatinShoulReturnIntWhenCreationIsSucceeded(): void
    {
        $dbMock = $this->getMockBuilder(DatabaseCreation::class)->disableOriginalConstructor()->getMock();

        $dbMock->method('createDatabase')->willReturn(0);

        $this->assertEquals(0, $dbMock->createDatabase());
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