<?php

namespace App\Model\Entity;

class Transaction
{

    public int $idTransaction;
    public string $description;
    public float $price;
    public string $category;
    public bool $io;

    private static float $totalInputs = 0;
    private static float $totalOutputs = 0;

    public function __construct(

        string $description,
        float $price,
        string $category,
        bool $io = null

    ){
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
        $this->io = $io;

        $this->io ? self::$totalInputs += $this->getPrice() : self::$totalOutputs += $this->getPrice();
    }

    private function getPrice(): float
    {
        return $this->price;
    }

    public static function getTotalInputs(): float
    {
        return self::$totalInputs;
    }

    public static function getTotalOutputs(): float
    {
        return self::$totalOutputs;
    }

}