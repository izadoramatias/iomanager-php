<?php

use App\Helper\RenderHome;
use App\Model\Repository\TransactionRepository;
use App\Model\Services\HomeService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

class HomeControllerTest extends TestCase
{
    public function testShouldCorrectlyRenderTotalInputValueCalculatedByTheService(): void
    {
        $crawler = $this->crawler('getAPriceListOfTransactionsInputType', [
            ['price' => 2],
            ['price' => 3],
            ['price' => 8],
            ['price' => 7]
        ]);

        $input = $crawler->filter('#input__money span:last-child')->text();

        $this->assertEquals('20,00', $input);
    }

    public function testShouldCorrectlyRenderTotalOutputValueCalculatedByTheService(): void
    {
        $crawler = $this->crawler('getAPriceListOfTransactionsOutputType', [
            ['price' => 1],
            ['price' => 2],
            ['price' => 2],
            ['price' => 5]
        ]);

        $output = $crawler->filter('#output__money span:last-child')->text();

        $this->assertEquals('10,00', $output);
    }

    public function testShouldCalculateTheDifferenceFromTotalOfInputTransactionsAndOutputTransactions(): void
    {
        $transactionRepostoryMock = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $transactionRepostoryMock->method('getAPriceListOfTransactionsInputType')->willReturn([
            ['price' => 1],
            ['price' => 2],
            ['price' => 2]
        ]);
        $transactionRepostoryMock->method('getAPriceListOfTransactionsOutputType')->willReturn([
            ['price' => 5],
            ['price' => 3],
            ['price' => 2]
        ]);

        $service = new HomeService($transactionRepostoryMock);
        $homeModel = $service->getHomeModel();
        $render = (new RenderHome())->renderToHtml($homeModel);

        $crawler = new Crawler($render);
        $total = $crawler->filter('#total__money span:last-child')->text();

        $this->assertEquals('-5,00', $total);
    }

    public function testShouldCorrectlyTransactionsRender(): void
    {
        $transactionRepositoryMock = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $transactionRepositoryMock->method('getTransactionsList')->willReturn([
            0 => [
                'description' => 'batata',
                'price' => 2.99,
                'category' => 'alimentação',
                'date' => '20/12/2022',
                'type' => 0
            ]
        ]);

        $service = new HomeService($transactionRepositoryMock);

        $homeModel = $service->getHomeModel();
        $render = (new RenderHome())->renderToHtml($homeModel);

        $crawler = new Crawler($render);
        $description = $crawler->filter('main section .description')->text();
        $price = $crawler->filter('main section .price')->text();
        $category = $crawler->filter('main section .category')->text();
        $date = $crawler->filter('main section .date')->text();

        $this->assertEquals('batata', $description);
        $this->assertEquals('2,99', $price);
        $this->assertEquals('alimentação', $category);
        $this->assertEquals('20/12/2022', $date);
    }

    private function crawler($testedMethod, $result): Crawler
    {
        $transactionRepositoryMock = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $transactionRepositoryMock
            ->method($testedMethod)
            ->willReturn($result);

        $homeService = new HomeService($transactionRepositoryMock);
        $homeModel = $homeService->getHomeModel();

        $render = (new RenderHome())->renderToHtml($homeModel);
        $crawler = new Crawler($render);

        return $crawler;
    }
}