<?php

namespace App\Http\Requests;

use App\Domains\Purchases\DTOs\FilterPurchasesDTO;
use App\Domains\Transactions\DTOs\FilterTransactionsDTO;
use Illuminate\Foundation\Http\FormRequest;

class ListTransactionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "year" => "required|integer|between:1900,2500",
            "month" => "required|integer|between:1,12"
        ];
    }

    public function toDTO(): FilterTransactionsDTO
    {
        return new FilterTransactionsDTO(
            $this->input("year"),
            $this->input("month")
        );
    }
}
