<?php


namespace App\Domains\Deposits\DTOs;


use Illuminate\Http\UploadedFile;

class DepositDTO
{
    public function __construct(
        public int $amount,
        public string $description,
        public UploadedFile $checkPicture,
        public int $userId
    )
    {
    }
}
