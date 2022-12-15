<?php

namespace Tests;

use App\Model\TransactionModel;
use PHPUnit\Framework\TestCase;

class TransactionModelTest extends TestCase
{
//    public function testShouldPositiveWhenThePriceIsEqualThanZero(): void
//    {
//        $transaction = new TransactionModel(price:0);
//        $this->assertTrue($transaction->isPositive());
//
//        $transaction->price = 1;
//        $this->assertTrue($transaction->isPositive());
//    }
//
//    public function testIsInputType(): void
//    {
//        $transaction = new TransactionModel('um juliette da oakley', 5.99, 'ganhando uma bufunfa', new \DateTimeImmutable('12/11/2022', new \DateTimeZone('UTC')), 1);
//        $this->assertTrue($transaction->isInputType());
//    }
//
//    public function testIsEmptyDescription(): void
//    {
//        $transaction = new TransactionModel(price: 4.99, category: 'vazio', date: new \DateTimeImmutable('11/11/2011'), type: 1);
//        $this->assertSame('', $transaction->description);
//    }
//
//    public function testIsEmptyPrice(): void
//    {
//        $transaction = new TransactionModel(description: 'boneco julio do cocóricó', category: 'humor&funny', date: new \DateTimeImmutable('09/08/2022'), type: 0);
//        $this->assertSame(0.0, $transaction->price);
//    }
//
//    public function testIsEmptyCategory(): void
//    {
//        $transaction = new TransactionModel(description: 'fantasia baby shark para gato', price: 65.00, date: new \DateTimeImmutable('01/12/2022'), type: 0);
//        $this->assertSame('', $transaction->category);
//    }
//
//    public function testIsEmptyDate(): void
//    {
//        $transaction = new TransactionModel(description: 'salário', price: 600, category: 'pagamento', type: 1);
//        $this->assertSame((new \DateTimeImmutable())->format('d/m/Y'), $transaction->date->format('d/m/Y'));
//    }
//
//    public function testIsEmptyType(): void
//    {
//        $transaction = new TransactionModel(description: 'jatinho de aventuras da barbie', price: 199.90, category: 'divertimentos', date: new \DateTimeImmutable('09/11/2021'));
//        $this->assertSame(1, $transaction->type);
//    }

    public function testShouldReturnTrueIfTransactionPriceIsEqualOrGreaterThanZero(): void
    {
        $transaction = new TransactionModel();

        $transaction->price = 10;

        $this->assertTrue($transaction->isPositive());
    }

    public function testShouldReturnFalseIfTransactionTypeIsLowerThanZero(): void
    {
        $transaction = new TransactionModel();

        $transaction->price = -10.99;

        $this->assertFalse($transaction->isPositive());
    }

    public function testShouldReturnTrueIfTransactionTypeIsOne(): void
    {
        $transaction = new TransactionModel(); // default type is 1

        $this->assertTrue($transaction->isInputType());
    }

    public function testShouldReturnFalseIfTransactionTypeIsZero(): void
    {
        $transaction = new TransactionModel(type: 0);

        $this->assertFalse($transaction->isInputType());
    }
}