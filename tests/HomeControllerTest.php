<?php

use App\Helper\RenderHome;
use App\Model\Repository\TransactionRepository;
use App\Model\Services\HomeService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

class HomeControllerTest extends TestCase
{
    public function testShouldRenderTotalInputsCalculatedByTheService(): void
    {
        $transactionRepositoryMock = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $transactionRepositoryMock->method('getAListWithThePricesOfTransactionsTypeInput')->willReturn([
            0 => 2,
            1 => 3,
            2 => 8,
            3 => 7
        ]); // total = 20,00

        $homeService = new HomeService($transactionRepositoryMock);
        $homeModel = $homeService->getHomeModel();

        $render = (new RenderHome())->renderToHtml($homeModel);
    $crawler = new Crawler($render);
        $input = $crawler->filter('#input__money span:last-child')->text();

        $this->assertEquals('20,00', $input);
    }

    public function testShouldRenderTotalOutputsCalculatedByTheService(): void
    {
        $transactionRepositoryMock = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $transactionRepositoryMock->method('getAListWithThePricesOfTransactionsTypeOutput')->willReturn([
            0 => 1,
            1 => 2,
            2 => 2,
            3 => 5
        ]); // total = 10,00

        $service = new HomeService($transactionRepositoryMock);
        $homeModel = $service->getHomeModel();
        $render = (new RenderHome())->renderToHtml($homeModel);

        $crawler = new Crawler($render);
        $output = $crawler->filter('#output__money span:last-child')->text();

        $this->assertEquals('10,00', $output);
    }

    public function testShouldRenderCalculatedTotal(): void
    {
        $transactionRepostoryMock = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $transactionRepostoryMock->method('getAListWithThePricesOfTransactionsTypeInput')->willReturn([
            1, 2, 2
        ]);
        $transactionRepostoryMock->method('getAListWithThePricesOfTransactionsTypeOutput')->willReturn([
            5, 3, 2
        ]);

        $service = new HomeService($transactionRepostoryMock);
        $homeModel = $service->getHomeModel();
        $render = (new RenderHome())->renderToHtml($homeModel);

        $crawler = new Crawler($render);
        $total = $crawler->filter('#total__money span:last-child')->text();

        $this->assertEquals('-5,00', $total);
    }

    public function testShouldBeCorrectlyRenderingTransactions(): void
    {
        $transactionRepositoryMock = $this
            ->getMockBuilder(TransactionRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $transactionRepositoryMock->method('getAListOfTransactions')->willReturn([
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

}