<?php

namespace App\Http\Requests;

use App\Domains\Authentication\DTOs\UserCredentialsDTO;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "username" => "required|alpha_num|max:30",
            "email" => "required|email",
            "password" => "required|min:6"
        ];
    }

    public function toDTO(): UserCredentialsDTO
    {
        return new UserCredentialsDTO(
            $this->input("username"),
            $this->input("password"),
            $this->input("email")
        );
    }
}
