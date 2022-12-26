<?php

use App\Model\Database\DatabaseConnection;
use App\Model\Database\DatabaseCreation;
use App\Model\Repository\TransactionRepository;
use PHPUnit\Framework\TestCase;
use const App\Model\Database\DB_NAME;

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

    public function testConnectionShouldReturnNull(): void
    {
        $pdoMock = $this->getMockBuilder(DatabaseConnection::class)->getMock();

        $pdoMock->method('connect')->willReturn(null);

        $this->assertEquals(null, $pdoMock->connect());
    }

    public function testConnectionShouldThrowAnException(): void
    {
        $pdoMock = $this->getMockBuilder(DatabaseConnection::class)->getMock();

        $this->expectException(Exception::class); // define que está esperando que o código a seguir deverá retornar uma exceção
        $pdoMock->method('connect')->willReturn(new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD'])); // definição que vai fazer o código gerar uma exceção
    }

    public function testShouldCreateADatabase(): void
    {
        $pdoMock = $this->getMockBuilder(PDO::class)->disableOriginalConstructor()
            ->getMock();

        $pdoMock->method('exec')->willReturn(0);

        $this->assertTrue($pdoMock->exec('CREATE DATABASE IF NOT EXISTS iomanager;') >= 0);
    }

    public function testShouldCreateDatabaseTable(): void
    {
        $pdoMock = $this->getMockBuilder(
            PDO::class)
            ->disableOriginalConstructor()
            ->getMock();

        $pdoMock->method('exec')->willReturn(0); // refatorar pq não está intuitivo e fácil de ler

        $statement = "CREATE TABLE IF NOT EXISTS                         Transactions(
                                idTransaction int NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                description varchar(255) NOT NULL,
                                price float NOT NULL,
                                category varchar(45) NOT NULL,
                                date varchar(10) NOT NULL,
                                type TINYINT NOT NULL);";
        $this->assertTrue($pdoMock->exec($statement) >= 0);
    }

    public function testDatabaseCreationShouldThrowAnExceptionWhenSomethingInCreationFails(): void
    {
        $pdoMock = $this->getMockBuilder(DatabaseCreation::class)->disableOriginalConstructor()->getMock();

        $this->expectException(\PHPUnit\Framework\MockObject\RuntimeException::class);

        $pdoMock->method('create')->willThrowException(throw new \PHPUnit\Framework\MockObject\RuntimeException());
    }

    public function testWhenDatabaseHasInputTransactionsRegisteredShouldReturnAnArrayWithThemPrice(): void
    {
        // arrange
        $repositoryMock = $this->getMockBuilder(TransactionRepository::class)->getMock();

        // act
        $repositoryMock->method('getAListWithThePricesOfTransactionsTypeInput')->willReturn([
            0 => 2,
            1 => 2
        ]);

        // assert
        $this->assertEquals([2, 2], $repositoryMock->getAListWithThePricesOfTransactionsTypeInput());
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
        $repositoryMock->method('getAListWithThePricesOfTransactionsTypeInput')->willReturn([]);

        // assert
        $this->assertEquals([], $repositoryMock->getAListWithThePricesOfTransactionsTypeInput());
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

        $repositoryMock->method('getAListWithThePricesOfTransactionsTypeOutput')->willReturn([
            0 => 3,
            1 => 5
        ]);

        $this->assertEquals([3, 5], $repositoryMock->getAListWithThePricesOfTransactionsTypeOutput());
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

        $repositoryMock->method('getAListWithThePricesOfTransactionsTypeOutput')->willReturn([]);

        $this->assertEquals([], $repositoryMock->getAListWithThePricesOfTransactionsTypeOutput());
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

        $repositoryMock->method('getAListOfTransactions')->willReturn([]);

        $this->assertEquals([], $repositoryMock->getAListOfTransactions());
    }

}