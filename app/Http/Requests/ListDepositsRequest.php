<?php

namespace App\Http\Requests;

use App\Domains\Deposits\DTOs\FilterDepositsDTO;
use App\Domains\Deposits\Enums\DepositStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class ListDepositsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "year" => "required|integer|between:1900,2500",
            "month" => "required|integer|between:1,12",
            "status" => "string",
        ];
    }

    public function toDTO(): FilterDepositsDTO
    {
        $dto = new FilterDepositsDTO(
            $this->input("year"),
            $this->input("month"),
        );

        if ($this->input("status")) {
            $dto->status = DepositStatusEnum::from($this->input("status"));
        }

        return $dto;
    }
}
