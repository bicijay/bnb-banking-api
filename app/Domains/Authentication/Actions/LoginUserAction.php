<?php


namespace App\Domains\Authentication\Actions;


use App\Domains\Authentication\DTOs\UserCredentialsDTO;
use App\Domains\Users\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginUserAction
{
    public function execute(UserCredentialsDTO $userCredentialsDTO): User
    {
        if (!Auth::attempt([
            'username' => $userCredentialsDTO->username,
            'password' => $userCredentialsDTO->password
        ])) {
            throw new \DomainException(__("The username or password is incorrect"));
        }

        return Auth::user();
    }
}
