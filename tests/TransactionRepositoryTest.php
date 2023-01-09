<?php

use App\Model\Database\DatabaseConnection;
use App\Model\Database\DatabaseCreation;
use App\Model\Database\PDOSingleConnection;
use App\Model\Repository\TransactionRepository;
use PHPUnit\Framework\TestCase;

class TransactionRepositoryTest extends TestCase
{
    public function testShouldReturnAPdoConnectionWhenConnectionIsSucceed(): void
    {
        $dbConnection = PDOSingleConnection::getPDO();

        $this->assertInstanceOf(PDO::class, $dbConnection);
    }

    public function testConnectionShouldThrowAnExceptionWhenSomeErrorOccurWhenTryingToConnect(): void
    {
        $db = new PDOSingleConnection();

        $this->expectException(PDOException::class);

        $db->getPDO(username: 'ro');
    }

    public function testShouldReturnAPdoObjectWhenDatabaseCreationIsSucceed(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();

        $pdoMock->method('exec')->willReturn(1);
        $db = new DatabaseCreation('iomanager', $pdoMock);

        $this->assertInstanceOf(PDO::class, $db->createDatabase());
    }


    public function testShouldReturnAPdoObjectWhenDatabaseTableCreationIsSucceed(): void
    {
        $pdoMock = $this->getMockBuilder(PDO::class)->disableOriginalConstructor()->getMock();
        $pdoMock
            ->method('exec')->willReturn(1);

        $db = new DatabaseCreation('iomanager', $pdoMock);

        $this->assertInstanceOf(PDO::class, $db->createTable());
    }

    public function testDatabaseCreationShouldThrowAnExceptionWhenSomethingInCreationFails(): void
    {
        $pdoMock = $this->getMockBuilder(PDO::class)->disableOriginalConstructor()->getMock();
        $pdoMock->method('exec')->willThrowException(new PDOException());

        $this->expectException(PDOException::class);

        (new DatabaseCreation('iomanager', $pdoMock))->createDatabase();
    }

    public function testDatabaseTableCreationShouldThrowAnExceptionWhenSomethingInCreationFails(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoMock->method('exec')->willThrowException(new PDOException());

        $this->expectException(PDOException::class);

        (new DatabaseCreation('iomanager', $pdoMock))->createTable();
    }





    public function testCreateTableShouldReturnFalse(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoMock->method('exec')->willReturn(false);

        $db = new DatabaseCreation('iomanager', $pdoMock);

        $this->assertInstanceOf(PDO::class, $db->createTable()); // mesmo quando exec é false ele está retornando uma instancia de PDO?????
    }

    public function testCreateDatabaseShouldReturnFalse(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoMock
            ->method('exec')
            ->withConsecutive(['CREATE DATABASE IF NOT EXISTS iomanager;'])
            ->willReturn(false);

        $db = new DatabaseCreation('iomanager', $pdoMock);

        $this->assertInstanceOf(PDO::class, $db->createDatabase());
    }

    public function testUseDatabaseShouldReturnFalse(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $pdoMock
            ->method('exec')
            ->willReturn(false)
            ->withConsecutive(
                ['CREATE DATABASE IF NOT EXISTS iomanager;'],
                ['USE iomanager;']);

        $db = new DatabaseCreation('iomanager', $pdoMock);

        $this->assertInstanceOf(PDO::class, $db->createDatabase());
    }





    // testes do repository
    public function testWhenDatabaseHasInputTransactionsRegisteredShouldReturnAnArrayWithThemPrice(): void
    {
        $pdoMock = $this
            ->getMockBuilder(PDO::class)->setConstructorArgs(['', 'root', '12345'])
            ->addMethods(['fetchAll'])
            ->getMock();
        $pdoMock->method('fetchAll')->willReturn([2, 2]);

        $transactionRepository = new TransactionRepository($pdoMock);

        $this->assertEquals([2, 2], $transactionRepository->getAListWithThePricesOfTransactionsTypeInput());
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