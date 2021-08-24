<?php


namespace App\Domains\Transactions\Actions;


use App\Domains\Transactions\DTOs\TransactionDTO;
use App\Domains\Transactions\Models\Transaction;

class CreateNewTransactionAction
{
    public function __construct(private UpdateUserBalanceAction $updateUserBalanceAction)
    {
    }

    public function execute(TransactionDTO $transactionDTO): Transaction
    {
        $transaction = Transaction::create([
            "type" => $transactionDTO->type,
            "amount" => $transactionDTO->amount,
            "description" => $transactionDTO->description,
            "user_id" => $transactionDTO->userId,
            "transaction_at" => $transactionDTO->transaction_at ?? new \DateTime() //default value for today
        ]);

        $this->updateUserBalanceAction->execute(
            $transactionDTO->userId,
            $transactionDTO->type,
            $transactionDTO->amount
        );

        return $transaction;
    }
}
