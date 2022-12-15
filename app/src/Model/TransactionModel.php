<?php

namespace App\Model;

class TransactionModel
{
    const TYPE_OUTPUT = 0;
    const TYPE_INPUT = 1;

    public function __construct(
        public string $description = '',
        public float $price = 0,
        public string $category = '',
        public \DateTimeImmutable|null $date = null,
        public int $type = self::TYPE_INPUT
    ) {
        $this->date = is_null($date) ? new \DateTimeImmutable() :  $date;
    }

    public function isPositive(): bool
    {
        return $this->price >= 0;
    }

    public function isInputType(): bool
    {
        return $this->type === self::TYPE_INPUT;
    }
}