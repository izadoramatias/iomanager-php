<?php

use App\Model\TransactionModel;
use PHPUnit\Framework\TestCase;
use App\Model\HomeModel;
use App\Helper\RenderHome;
use Symfony\Component\DomCrawler\Crawler;

class RenderHomeTest extends TestCase
{
    public function testInputNumberShouldBeCorrectlyFormatedReplacingDecimalPointingNumberSeparatorWithComma(): void
    {
        // arrange
        $homeModel = new HomeModel();
        $render = new RenderHome();
        $homeModel->totalInputTransactions = 1.99;

        // act
        $html = $render->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $input = $crawler->filter('#input__money span:last-child')->text();

        $this->assertEquals('1,99', $input);
    }

    public function testOutputNumberShouldBeCorrectlyFormatedReplacingDecimalPointingNumberSeparatorWithComma(): void
    {
        // arrange
        $homeModel = new HomeModel();
        $renderHome = new RenderHome();
        $homeModel->totalOutputTransactions = 1.99;

        // act
        $html = $renderHome->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $output = $crawler->filter('#output__money span:last-child')->text();

        // assert
        $this->assertEquals('1,99', $output);
    }

    public function testTotalNumberShouldBeCorrectlyFormatedReplacingDecimalPointingNumberSeparatorWithComma(): void
    {
        // arrange
        $homeModel = new HomeModel();
        $renderHome = new RenderHome();
        $homeModel->totalInputTransactions = 1.99;

        // act
        $html = $renderHome->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $total = $crawler->filter('#total__money span:last-child')->text();

        // assert
        $this->assertEquals('1,99', $total);
    }

    public function testWhenTotalIsNegativeShouldHaveADashBeforeTheNumber(): void
    {
        $homeModel = new HomeModel();
        $renderHome = new RenderHome();
        $homeModel->totalOutputTransactions = 1.99;

        $html = $renderHome->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $total = $crawler->filter('#total__money span:last-child')->text();

        $this->assertEquals('-1,99', $total);
    }

    // redundante???
    public function testWhenTotalIsPositiveShouldNotHaveADashBeforeTheNumber(): void
    {
        $homeModel = new HomeModel();
        $renderHome = new RenderHome();

        $html = $renderHome->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $total = $crawler->filter('#total__money span:last-child')->text();
        $this->assertEquals('0,00', $total);

        $homeModel->totalInputTransactions = 1.99;
        $html = $renderHome->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $total = $crawler->filter('#total__money span:last-child')->text();
        $this->assertEquals('1,99', $total);
    }

    public function testWhenTotalIsPositiveShouldHaveClassPositiveCredit(): void
    {
        $homeModel = new HomeModel();
        $renderHome = new RenderHome();

        // se total for zero
        $html = $renderHome->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $classesTotal = $crawler->filter('.total__data')->attr('class');
        $this->assertStringContainsString('positive__credit', $classesTotal);

        $homeModel->totalInputTransactions = 1.99;
        $html = $renderHome->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $classesTotal = $crawler->filter('.total__data')->attr('class');
        $this->assertStringContainsString('positive__credit', $classesTotal);
    }

    public function testWhenTotalIsNegativeShouldHaveClassNegativeCredit(): void
    {
        $homeModel = new HomeModel();
        $renderHome = new RenderHome();
        $homeModel->totalOutputTransactions = 1.99;

        $html = $renderHome->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $classesTotal = $crawler->filter('.total__data')->attr('class');
        $this->assertStringContainsString('negative__credit', $classesTotal);
    }

    public function testWhenAddATransactionItShouldHaveIntoASection(): void
    {
        $homeModel = new HomeModel();
        $renderHome = new RenderHome();
        $homeModel->addTransaction(new TransactionModel('batata', 2.98, 'alimentação', new \DateTimeImmutable('yesterday'), 0));

        $html = $renderHome->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $transaction = $crawler->filter('main')->html();

        $this->assertStringContainsString('<section>', $transaction);
        $this->assertStringContainsString('</section>', $transaction);
    }

    public function testTransactionShouldHaveADescription(): void
    {
        $homeModel = new HomeModel;
        $renderHome = new RenderHome();
        $homeModel->addTransaction(new TransactionModel(description: 'batata'));

        $html = $renderHome->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $getDescription = $crawler->filter('main section .description')->html();

        $this->assertEquals('batata', $getDescription);
    }

    public function testTransactionShouldHaveAPrice(): void
    {
        $homeModel = new HomeModel();
        $renderHome = new RenderHome();
        $homeModel->addTransaction(new TransactionModel(price: 1.99));

        $html = $renderHome->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $getPrice = $crawler->filter('main section .price')->html();

        $this->assertEquals('1,99', $getPrice);
    }

    public function testTransactionShouldHaveACategory(): void
    {
        $homeModel = new HomeModel();
        $renderHome = new RenderHome();
        $homeModel->addTransaction(new TransactionModel(category: 'alimentação'));

        $html = $renderHome->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $getCategory = $crawler->filter('main section .category')->html();

        $this->assertEquals('alimentação', $getCategory);
    }

    public function testTransactionShouldHaveDate(): void
    {
        $homeModel = new HomeModel();
        $renderHome = new RenderHome();
        $homeModel->addTransaction(new TransactionModel(date: new DateTimeImmutable('26-12-2022')));

        $html = $renderHome->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $getDate = $crawler->filter('main section .date')->html();

        $this->assertEquals('26/12/2022', $getDate);
    }

    public function testTransactionShouldHaveAInputTypePriceInputWhenTypeIsOne(): void
    {
        $homeModel = new HomeModel();
        $renderHome = new RenderHome();
        $homeModel->addTransaction(new TransactionModel(type: 1));

        $html = $renderHome->renderToHtml($homeModel);
        $crawler = new Crawler($html);
        $getInputType = $crawler->filter('main section .price')->attr('class');

        $this->assertStringContainsString('price__input', $getInputType);
    }

    public function testTransactionShouldHaveAInputTypePriceOutputWhenTypeIsZero(): void
    {
       $homeModel = new HomeModel();
       $renderHome = new RenderHome();
       $homeModel->addTransaction(new TransactionModel(type: 0));

       $html = $renderHome->renderToHtml($homeModel);
       $crawler = new Crawler($html);
       $getInputType = $crawler->filter('main section .price')->attr('class');

       $this->assertStringContainsString('price__output', $getInputType);
    }
}


