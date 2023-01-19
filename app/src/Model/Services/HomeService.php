<?php

namespace App\Model\Services;

use App\Model\HomeModel;
use App\Model\TransactionModel;
use JetBrains\PhpStorm\ArrayShape;

class HomeService
{
    public function __construct(
        public HomeServiceInterface $transactionRepository
    ) {}

    public function getHomeModel(): HomeModel
    {
        $homeModel = new HomeModel();
        $repositoryLists = $this->arrayWithTransactionRepositoryLists();

        $homeModel->totalInputTransactions = $this
            ->calculateTotalInputTransactions($repositoryLists['inputTransactionsList']);
        $homeModel->totalOutputTransactions = $this
            ->calculateTotalOutputTransactions($repositoryLists['outputTransactionsList']);
        $homeModel->addTransactions($this
            ->convertTransactionsFromArrayToObject($repositoryLists['transactionsList']));

        return $homeModel;
    }

    public function calculateTotalInputTransactions(array $inputTransactionsList): float
    {
        $total = 0;
<<<<<<< HEAD
        foreach ($inputTransactionsList as $price) {
=======
<<<<<<< Updated upstream
        foreach ($inputsArray as $price) {
=======
        foreach ($inputTransactionsList[0] as $price) {
>>>>>>> Stashed changes
>>>>>>> dev
            $total += $price;
        }

        return $total;
    }

    public function calculateTotalOutputTransactions(array $outputTransactionsList): float
    {
        $total = 0;
<<<<<<< HEAD
        foreach ($outputTransactionsList as $price) {
=======
<<<<<<< Updated upstream
        foreach ($outputsArray as $price) {
=======
        foreach ($outputTransactionsList[0] as $price) {
>>>>>>> Stashed changes
>>>>>>> dev
            $total += $price;
        }

        return $total;
    }

    public function convertTransactionsFromArrayToObject(array $transactionsList): array
    {
        $arrayTransactions = [];
        foreach ($transactionsList as $transaction) {
            extract($transaction, EXTR_OVERWRITE);

            $transactionToObject = new TransactionModel($description, $price, $category, (new \DateTimeImmutable)::createFromFormat('d/m/Y', $date), $type);
            $arrayTransactions[] = $transactionToObject;
        }

        return $arrayTransactions;
    }

    private function arrayWithTransactionRepositoryLists(): array
    {
        $inputTransactionsList = $this
            ->transactionRepository
            ->getAListWithThePricesOfTransactionsTypeInput();
        $outputTransactionsList = $this
            ->transactionRepository
            ->getAListWithThePricesOfTransactionsTypeOutput();
        $transactionsList = $this
            ->transactionRepository
            ->getAListOfTransactions();

        return [
            'inputTransactionsList' => $inputTransactionsList,
            'outputTransactionsList' => $outputTransactionsList,
            'transactionsList' => $transactionsList
        ];

    }
}

//class RepositoryFake implements HomeService{
//
//    public function getTotalInputTransactions(): array
//    {
//        return [
//            new TransactionModel(price: 2),
//            new TransactionModel(price: 2)
//        ];
//    }
//
//    public function getTotalOutputTransactions(): array
//    {
//        return [
//            new TransactionModel(price: 3, type: TransactionModel::TYPE_OUTPUT),
//            new TransactionModel(price: 5, type: TransactionModel::TYPE_OUTPUT),
//        ];
//    }
//
//    public function getTransactions(): array
//    {
//        return [
//            new TransactionModel(price: 2),
//            new TransactionModel(price: 2),
//            new TransactionModel(price: 3, type: TransactionModel::TYPE_OUTPUT),
//            new TransactionModel(price: 5, type: TransactionModel::TYPE_OUTPUT),
//        ];
//    }
//}
//
//$r = new RepositoryFake();
//
//$s = new TransactionServices($r);
//
//$h = $s->getHomeModel();

