<?php

namespace App\Http\Requests;

use App\Domains\Deposits\DTOs\DepositDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateDepositRequest extends FormRequest
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
            "check_picture" => "required|image"
        ];
    }

    public function toDTO(): DepositDTO
    {
        return new DepositDTO(
            $this->input("amount"),
            $this->input("description"),
            $this->file("check_picture"),
            Auth::user()->id,
        );
    }
}
