<?php


namespace App\Domains\Deposits\Actions;


use App\Domains\Deposits\DTOs\DepositDTO;
use App\Domains\Deposits\Enums\DepositStatusEnum;
use App\Domains\Deposits\Models\Deposit;
use App\Domains\Images\Actions\CreateNewImageAction;
use Illuminate\Support\Facades\DB;

class CreateNewDepositAction
{
    public function __construct(private CreateNewImageAction $createNewImageAction)
    {
    }

    public function execute(DepositDTO $depositDTO): Deposit
    {
        return DB::transaction(function () use ($depositDTO) {
            $savedCheckImage = $this->createNewImageAction->execute($depositDTO->checkPicture, $depositDTO->userId);

            return Deposit::create([
                "amount" => $depositDTO->amount,
                "description" => $depositDTO->description,
                "status" => DepositStatusEnum::pending(),
                "image_id" => $savedCheckImage->id,
                "user_id" => $depositDTO->userId
            ])->load("image");
        });
    }
}
