<?php

namespace App\Http\Requests;

use App\Domains\Authentication\DTOs\UserCredentialsDTO;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "username" => "required|alpha_num|max:30",
            "password" => "required|min:6"
        ];
    }

    public function toDTO(): UserCredentialsDTO
    {
        return new UserCredentialsDTO(
            $this->input("username"),
            $this->input("password")
        );
    }
}
