<?php

namespace App\Http\Requests;

use App\Domains\Purchases\DTOs\PurchaseDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            "amount" => "required|integer",
            "description" => "required|max:255",
            "purchased_at" => "required|date_format:Y-m-d"
        ];
    }

    public function toDTO(): PurchaseDTO
    {
        return new PurchaseDTO(
            $this->input("amount"),
            $this->input("description"),
            \DateTime::createFromFormat("Y-m-d", $this->input("purchased_at")),
            Auth::user()->id
        );
    }
}
