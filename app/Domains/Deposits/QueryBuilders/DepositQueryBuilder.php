<?php


namespace App\Domains\Deposits\QueryBuilders;


use App\Domains\Deposits\DTOs\FilterDepositsDTO;
use App\Domains\Deposits\Enums\DepositStatusEnum;
use Illuminate\Database\Eloquent\Builder;

class DepositQueryBuilder extends Builder
{
    public function findByFilters(FilterDepositsDTO $filterDepositsDTO): DepositQueryBuilder
    {
        $query = $this
            ->whereMonth("created_at", $filterDepositsDTO->month)
            ->whereYear("created_at", $filterDepositsDTO->year);

        if ($filterDepositsDTO->status) {
            $query->where("status", $filterDepositsDTO->status);
        }

        return $query->orderByDesc("created_at");
    }

    public function wherePending(): DepositQueryBuilder
    {
        return $this->where("status", DepositStatusEnum::pending())
            ->orderByDesc("created_at");
    }
}
