<?php

namespace Manager\Model;

class Transaction
{

    private int $idTransaction;
    private string $description;
    private float $price;
    private string $category;
    private bool $io; // input/output

    private static float $totalInputs = 0;
    private static float $totalOutputs = 0;


    public function __construct(
        string $description,
        float $price,
        string $category,
        bool $io = null

    ) {
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
        $this->io = $io;

        $this->io ? self::$totalInputs += $this->getPrice() : self::$totalOutputs += $this->getPrice();
    }

    // para pegar o ID da transação, será preciso acessar o banco
    public function getIdTransaction(): int
    {
        return $this->idTransaction;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getIO(): bool
    {
        return $this->io;
    }

    public function setIO(bool $io): void
    {
        $this->io = $io;
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