<?php

namespace App\Model\Entity;

class Transaction
{

    public int $idTransaction;
    public string $description;
    public float $price;
    public string $category;
    private string $date;
    public bool $io;

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
        $this->date = $date;
        $this->io = $io;
    }

}