<?php


namespace App\Domains\Transactions\QueryBuilders;


use App\Domains\Transactions\DTOs\FilterTransactionsDTO;
use Illuminate\Database\Eloquent\Builder;

class TransactionQueryBuilder extends Builder
{
    public function findByFilters(FilterTransactionsDTO $filterTransactionsDTO): TransactionQueryBuilder
    {
        return $this
            ->whereMonth("transaction_at", $filterTransactionsDTO->month)
            ->whereYear("transaction_at", $filterTransactionsDTO->year)
            ->orderByDesc("transaction_at");
    }
}
