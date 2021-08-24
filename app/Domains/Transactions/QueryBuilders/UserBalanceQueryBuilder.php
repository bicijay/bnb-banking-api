<?php


namespace App\Domains\Transactions\QueryBuilders;


use App\Domains\Transactions\Models\UserBalance;
use Illuminate\Database\Eloquent\Builder;

class UserBalanceQueryBuilder extends Builder
{
    public function findByUserId(int $userId): UserBalance
    {
        return $this->where("user_id", $userId)->get()->first();
    }

    public function getUserCurrentBalance(int $userId): int
    {
        return $this->findByUserId($userId)->current_balance ?? 0;
    }
}
