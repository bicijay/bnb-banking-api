<?php


namespace App\Domains\Purchases\DTOs;


class PurchaseDTO
{
    public function __construct(
        public int $amount,
        public string $description,
        public \DateTime $purchasedAt,
        public int $userId
    )
    {
    }
}
