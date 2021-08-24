<?php


namespace App\Domains\Transactions\Actions;


use App\Domains\Transactions\Enums\TransactionTypeEnum;
use App\Domains\Transactions\Models\UserBalance;

class UpdateUserBalanceAction
{
    public function __construct(private CreateNewUserBalanceAction $createNewUserBalanceAction)
    {
    }

    public function execute(int $userId, TransactionTypeEnum $transactionType, int $amount): UserBalance
    {
        $userBalance = UserBalance::query()->findByUserId($userId);

        if (!$userBalance) {
            $userBalance = $this->createNewUserBalanceAction->execute($userId);
        }

        if ($transactionType->equals(TransactionTypeEnum::income())) {
            $userBalance->increment("total_incomes", $amount);
            $userBalance->increment("current_balance", $amount);
        }

        if ($transactionType->equals(TransactionTypeEnum::expense())) {
            $userBalance->increment("total_expenses", $amount);
            $userBalance->decrement("current_balance", $amount);
        }

        $userBalance->save();
        return $userBalance;
    }
}
