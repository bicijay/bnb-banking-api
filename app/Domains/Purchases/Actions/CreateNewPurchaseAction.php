<?php


namespace App\Domains\Purchases\Actions;


use App\Domains\Purchases\DTOs\PurchaseDTO;
use App\Domains\Purchases\Models\Purchase;
use App\Domains\Transactions\Actions\CreateNewTransactionAction;
use App\Domains\Transactions\DTOs\TransactionDTO;
use App\Domains\Transactions\Enums\TransactionTypeEnum;
use App\Domains\Transactions\Models\UserBalance;
use Illuminate\Support\Facades\DB;

class CreateNewPurchaseAction
{
    public function __construct(private CreateNewTransactionAction $createNewTransactionAction)
    {
    }

    public function execute(PurchaseDTO $purchaseDTO): Purchase
    {
        return DB::transaction(function () use ($purchaseDTO) {

            if ($purchaseDTO->purchasedAt > new \DateTime()) {
                throw new \DomainException(__("You cannot make future purchases"));
            }

            $userBalance = UserBalance::query()->getUserCurrentBalance($purchaseDTO->userId);

            if ($purchaseDTO->amount > $userBalance) {
                throw new \DomainException(__("You do not have enough balance for this purchase"));
            }

            $createdTransaction = $this->createNewTransactionAction->execute(new TransactionDTO(
                $purchaseDTO->amount,
                TransactionTypeEnum::expense(),
                $purchaseDTO->description,
                $purchaseDTO->userId,
                $purchaseDTO->purchasedAt
            ));

            return Purchase::create([
                'amount' => $purchaseDTO->amount,
                'description' => $purchaseDTO->description,
                'purchased_at' => $purchaseDTO->purchasedAt,
                'transaction_id' => $createdTransaction->id,
                'user_id' => $purchaseDTO->userId
            ]);
        });
    }
}
