<?php


namespace App\Domains\Transactions\DTOs;


class FilterTransactionsDTO
{
    public function __construct(
        public int $year,
        public int $month
    )
    {
    }
}
