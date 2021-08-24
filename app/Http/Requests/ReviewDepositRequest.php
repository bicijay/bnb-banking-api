<?php

namespace App\Http\Requests;

use App\Domains\Deposits\DTOs\ReviewDepositDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReviewDepositRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "accepted" => "present|boolean",
        ];
    }

    public function toDTO(): ReviewDepositDTO
    {
        return new ReviewDepositDTO(
            $this->route("depositId"),
            Auth::user()->id,
            $this->boolean("accepted"),
            $this->input("reason")
        );
    }
}
