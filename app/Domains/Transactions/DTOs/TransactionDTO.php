<?php


namespace App\Domains\Transactions\DTOs;


use App\Domains\Transactions\Enums\TransactionTypeEnum;

class TransactionDTO
{
    public function __construct(
        public int $amount,
        public TransactionTypeEnum $type,
        public string $description,
        public int $userId,
        public ?\DateTime $transaction_at = null
    )
    {
    }
}
