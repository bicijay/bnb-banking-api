<?php


namespace App\Domains\Deposits\DTOs;


class ReviewDepositDTO
{
    public function __construct(
        public int $depositId,
        public int $reviewed_by,
        public bool $accepted,
        public ?string $reason = null
    )
    {}
}
