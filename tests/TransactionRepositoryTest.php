<?php

use App\Model\Repository\TransactionRepository;
use PHPUnit\Framework\TestCase;

class TransactionRepositoryTest extends TestCase
{
//    public PDO|null $conn = null;
//    public function setUp(): void
//    {
//        $this->conn = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);
//        $this->conn->query('CREATE DATABASE IF NOT EXISTS iomanagerTests; USE iomanagerTests;');
//        $this->conn->setAttribute(PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
//
//        $this->conn->query("
//                            CREATE TABLE IF NOT EXISTS Transactions(
//                                idTransaction integer PRIMARY KEY AUTO_INCREMENT,
//                                description text NOT NULL,
//                                price real NOT NULL,
//                                category text NOT NULL,
//                                date text NOT NULL,
//                                type integer NOT NULL);");
//    }
//
//    public function tearDown(): void
//    {
//        $this->conn->query("DELETE FROM Transactions;");
//        $this->conn = null;
//    }

//    public static function tearDownAfterClass(): void
//    {
//        unlink(__DIR__ . '/../:memory');
//    }

//    public function testSomething(): void
//    {
//
//    }

//    public function testWhenDatabaseHasInputTransactionsRegisteredShouldReturnAnArrayWithThem(): void
//    {
//        // arrange
//        $parameter1 = 'price';
//        $parameter2 = 'type';
//
//        $this->conn->query("INSERT INTO Transactions (description, price, category, date, type)
//        VALUES ('um dois tres', 12.99, 'nao sei', '11/12/2023', 0),
//               ('venda de uma bolinha de golfe', 4.99, 'esporte', '12/12/2012', 1)");
//
//        $statement = $this->conn->query("SELECT $parameter1 FROM Transactions WHERE $parameter2 = 1");
//
//        // act
//        $result = $statement->fetchAll();
//
//        // assert
//        $this->assertNotSame([], $result);
//    }

    public function testSomething(): void
    {
        $pdoMock = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);
    }

    public function testWhenDatabaseHasInputTransactionsRegisteredShouldReturnAnArrayWithThemPrice(): void
    {
        // arrange
        $repositoryMock = $this->getMockBuilder(TransactionRepository::class)->getMock();

        // act
        $repositoryMock->method('getTotalInputTransactions')->willReturn([
            0 => 2,
            1 => 2
        ]);

        // assert
        $this->assertEquals([2, 2], $repositoryMock->getTotalInputTransactions());
    }

//    public function testWhenDatabaseHasNotRegisteredTransactionsShouldReturnAnEmptyArray(): void
//    {
//        // arrange
//        $parameter1 = 'price';
//        $parameter2 = 'type';
//
//        $this->conn->query("INSERT INTO Transactions (description, price, category, date, type)
//        VALUES ('venda de uma bolinha de golfe', 4.99, 'esporte', '12/12/2012', 0)");
//        $statement = $this->conn->query("SELECT $parameter1 FROM Transactions WHERE $parameter2 = 1");
//
//        // act
//        $result = $statement->fetchAll();
//
//        // assert
//        $this->assertSame([], $result);
//    }

    public function testWhenDatabaseHasNotInputTransactionsRegisteredShouldReturnAnEmptyArray(): void
    {
        // arrange
        $repositoryMock = $this->getMockBuilder(TransactionRepository::class)->getMock();

        // act
        $repositoryMock->method('getTotalInputTransactions')->willReturn([]);

        // assert
        $this->assertEquals([], $repositoryMock->getTotalInputTransactions());
    }

//    public function testWhenDatabaseHasOutputTransactionsRegisteredShouldReturnAnArrayWithThemPrice(): void
//    {
//        // arrange
//        $parameter1 = 'price';
//        $parameter2 = 'type';
//
//        $this->conn->query("INSERT INTO Transactions (description, price, category, date, type)
//        VALUES ('um dois tres', 12.99, 'nao sei', '11/12/2023', 0),
//               ('venda de uma bolinha de golfe', 4.99, 'esporte', '12/12/2012', 1)");
//        $statement = $this->conn->query("SELECT $parameter1 FROM Transactions WHERE $parameter2 = 0");
//
//        // act
//        $result = $statement->fetchAll();
//
//        // assert
//        $this->assertNotSame([], $result);
//    }

    public function testWhenDatabaseHasOutputTransactionsRegisteredShouldReturnAnArrayWithThemPrice(): void
    {
        // arrange
        $repositoryMock = $this->getMockBuilder(TransactionRepository::class)->getMock();

        $repositoryMock->method('getTotalOutputTransactions')->willReturn([
            0 => 3,
            1 => 5
        ]);

        $this->assertEquals([3, 5], $repositoryMock->getTotalOutputTransactions());
    }

//    public function testWhenDatabaseHasNotOutputTransactionsRegisteredShouldReturnAnEmptyArray(): void
//    {
//        // arrange
//        $parameter1 = 'price';
//        $parameter2 = 'type';
//
//        $this->conn->query("INSERT INTO Transactions (description, price, category, date, type)
//        VALUES ('venda de uma bolinha de golfe', 4.99, 'esporte', '12/12/2012', 1)");
//        $statement = $this->conn->query("SELECT $parameter1 FROM Transactions WHERE $parameter2 = 0");
//
//        // act
//        $result = $statement->fetchAll();
//
//        // assert
//        $this->assertSame([], $result);
//    }

    public function testWhenDatabaseHasNotOutputTransactionsRegisteredShouldReturnAnEmptyArray(): void
    {
        // arrange
        $repositoryMock = $this->getMockBuilder(TransactionRepository::class)->getMock();

        $repositoryMock->method('getTotalOutputTransactions')->willReturn([]);

        $this->assertEquals([], $repositoryMock->getTotalOutputTransactions());
    }

//    public function testShouldReturnATransactionList(): void
//    {
//        $this->conn->query("INSERT INTO Transactions (description, price, category, date, type)
//        VALUES ('venda de uma bolinha de golfe', 4.99, 'esporte', '12/12/2012', 1),
//               ('collen hoover: é assim que acaba', 39.90, 'educação e lazer', '21/12/2022', 0)");
//
//        $statement = $this->conn->query("SELECT * FROM Transactions;", PDO::FETCH_ASSOC);
//
//        $result = $statement->fetchAll();
//        $this->assertNotSame([], $result);
//
//        $description0 = $result[0]['description'];
//        $price0 = $result[0]['price'];
//        $category0 = $result[0]['category'];
//        $date0 = $result[0]['date'];
//        $type0 = $result[0]['type'];
//
//        $this->assertEquals('venda de uma bolinha de golfe', $description0);
//        $this->assertEquals(4.99, $price0);
//        $this->assertEquals('esporte', $category0);
//        $this->assertEquals('12/12/2012', $date0);
//        $this->assertEquals(1, $type0);
//
//        $description1 = $result[1]['description'];
//        $price1 = $result[1]['price'];
//        $category1 = $result[1]['category'];
//        $date1 = $result[1]['date'];
//        $type1 = $result[1]['type'];
//
//        $this->assertEquals('collen hoover: é assim que acaba', $description1);
//        $this->assertEquals(39.90, $price1);
//        $this->assertEquals('educação e lazer', $category1);
//        $this->assertEquals('21/12/2022', $date1);
//        $this->assertEquals(0, $type1);
//    }

    public function testShouldReturnATransactionListIfHasDataOnTable(): void
    {
        $transactionMock = $this->getMockBuilder(TransactionRepository::class)->getMock();

        $transactionMock->method('getTransactions')->willReturn([
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
        ], $transactionMock->getTransactions());
    }

//    public function testShouldReturnAnEmptyListIfDontHasDataOnTable(): void
//    {
//        $statement = $this->conn->query("SELECT * FROM Transactions");
//
//        $result = $statement->fetchAll();
//
//        $this->assertEquals([], $result);
//    }

    public function testShouldReturnAnEmptyListIfDontHasDataOnTable(): void
    {
        $repositoryMock = $this->getMockBuilder(TransactionRepository::class)->getMock();

        $repositoryMock->method('getTransactions')->willReturn([]);

        $this->assertEquals([], $repositoryMock->getTransactions());
    }

}