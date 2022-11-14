<?php

namespace App\Model\Entity;

use App\Model\Services\DataTypeTransaction;

class Transaction
{

    public int $idTransaction;
    public string $description;
    public float $price;
    public string $category;
    private string $date;
    public bool $io;

    private static float $totalInputs = 0;
    private static float $totalOutputs = 0;

    public function __construct(

        string $description,
        float $price,
        string $category,
        string $date,
        bool $io = null

    ){
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
        $this->io = $io;
        $this->date = $date;
    }

    public function getPrice(): float
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

    public static function setTotalInputs(float $input = 0): float
    {
        return self::$totalInputs += $input;
    }

    public static function setTotalOutputs(float $output = 0): float
    {
        return self::$totalOutputs += $output;
    }

}