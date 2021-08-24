<?php


namespace App\Domains\Purchases\QueryBuilders;


use App\Domains\Purchases\DTOs\FilterPurchasesDTO;
use Illuminate\Database\Eloquent\Builder;

class PurchaseQueryBuilder extends Builder
{
    public function findByFilters(FilterPurchasesDTO $filterPurchasesDTO): PurchaseQueryBuilder
    {
        return $this
            ->whereMonth("purchased_at", $filterPurchasesDTO->month)
            ->whereYear("purchased_at", $filterPurchasesDTO->year)
            ->orderByDesc("purchased_at");
    }
}
