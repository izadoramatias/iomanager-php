<?php

use App\Helper\RenderHome;
use App\Model\HomeModel;
use App\Model\Repository\TransactionRepository;
use App\Model\Services\HomeService;
use App\Model\TransactionModel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DomCrawler\Crawler;

//class HomeControllerTest extends TestCase
{
//    public function testShouldCreateAndBuildHomeModelAndRenderIt(): void
//    {
//        $homeModel = new HomeModel();
//        $transactionRepository = new TransactionRepository();
//
//        $homeModel->totalInputTransactions = $transactionRepository->getTotalInputTransactions();
//        $homeModel->totalOutputTransactions = $transactionRepository->getTotalOutputTransactions();
//        $homeModel->addTransactions($transactionRepository->getTransactions());
//        $this->assertInstanceOf(HomeModel::class, $homeModel);
//
//        $render = new RenderHome();
//        $expectedHomeModel = new HomeModel();
//        $expectedHomeModel->addTransactions($transactionRepository->getTransactions());
//        $expectedHomeModel->totalInputTransactions = 0;
//        $expectedHomeModel->totalOutputTransactions = 0;
//
////        echo $render->renderToHtml($expectedHomeModel);
////        echo $render->renderToHtml($homeModel);
//        $this->assertSame($render->renderToHtml($expectedHomeModel), $render->renderToHtml($homeModel));
//    }

    // faz sentido????
//    public function testShouldReturnTrueIfInputAndOutputTransactionsValuesAreHowTheExpected(): void
//    {
//        $homeModel = new HomeModel();
//        $transactionRepository = new TransactionRepository();
//        $homeModelService = new HomeService($transactionRepository);
//
//        $homeModel->totalInputTransactions = $homeModelService->calculateTotalInputTransactions();
//        $homeModel->totalOutputTransactions = $homeModelService->calculateTotalOutputTransactions();
//
//        $this->assertEquals(0, $homeModel->totalInputTransactions);
//        $this->assertEquals(2.98, $homeModel->totalOutputTransactions);
//    }
//
//    public function testShouldReturnTrueIfTransactionsValuesIsAnInteger(): void
//    {
//        // arrange
//        $homeModel = new HomeModel();
//        $render = new RenderHome();
//        $html = $render->renderToHtml($homeModel);
//        $crawler = new Crawler($html);
//
//        // act
//        $input = strpos($crawler->filter('#input__money')->text(), '0,00');
//        $output = strpos($crawler->filter('#output__money')->text(), '0,00');
//        $total = strpos($crawler->filter('#total__money')->text(), '0,00');
//
//        // assert
//        $this->assertIsInt($input);
//        $this->assertIsInt($output);
//        $this->assertIsInt($total);
//    }
}