<?php


namespace App\Domains\Deposits\Actions;


use App\Domains\Deposits\DTOs\ReviewDepositDTO;
use App\Domains\Deposits\Enums\DepositStatusEnum;
use App\Domains\Deposits\Models\Deposit;
use App\Domains\Transactions\Actions\CreateNewTransactionAction;
use App\Domains\Transactions\DTOs\TransactionDTO;
use App\Domains\Transactions\Enums\TransactionTypeEnum;
use Illuminate\Support\Facades\DB;

class ReviewDepositAction
{
    public function __construct(private CreateNewTransactionAction $createNewTransactionAction)
    {
    }

    public function execute(ReviewDepositDTO $reviewDepositDTO): Deposit
    {
        return DB::transaction(function () use ($reviewDepositDTO) {
            $deposit = Deposit::find($reviewDepositDTO->depositId);

            if (!$deposit) {
                throw new \DomainException(__("This deposit does not exists"));
            }

            if ($deposit->status !== DepositStatusEnum::pending()->value) {
                throw new \DomainException(__("This deposit already has a review"));
            }

            if (!$reviewDepositDTO->accepted) {
                return $this->rejectDeposit($deposit, $reviewDepositDTO);
            }

            return $this->acceptDeposit($deposit, $reviewDepositDTO);
        });
    }


    private function rejectDeposit(Deposit $deposit, ReviewDepositDTO $reviewDepositDTO): Deposit
    {
        $deposit->fill([
            "status" => DepositStatusEnum::rejected(),
            "reviewed_by" => $reviewDepositDTO->reviewed_by,
            "rejection_reason" => $reviewDepositDTO->reason
        ]);

        $deposit->save();
        return $deposit;
    }

    private function acceptDeposit(Deposit $deposit, ReviewDepositDTO $reviewDepositDTO): Deposit
    {
        $createdTransaction = $this->createNewTransactionAction->execute(new TransactionDTO(
            $deposit->amount,
            TransactionTypeEnum::income(),
            $deposit->description,
            $deposit->user_id
        ));

        $deposit->fill([
            "status" => DepositStatusEnum::accepted(),
            "reviewed_by" => $reviewDepositDTO->reviewed_by,
            "transaction_id" => $createdTransaction->id
        ]);

        $deposit->save();
        return $deposit;
    }
}
