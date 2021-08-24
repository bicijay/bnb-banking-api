<?php


namespace App\Domains\Transactions\Actions;


use App\Domains\Transactions\Models\UserBalance;

class CreateNewUserBalanceAction
{
    public function execute(int $userId): UserBalance
    {
        return UserBalance::create(["user_id" => $userId]);
    }
}
