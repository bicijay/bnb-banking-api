<?php


namespace App\Domains\Users\Actions;


use App\Domains\Transactions\Actions\CreateNewUserBalanceAction;
use App\Domains\Users\DTOs\UserDTO;
use App\Domains\Users\Enums\UserRoleEnum;
use App\Domains\Users\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateNewUserAction
{
    public function __construct(private CreateNewUserBalanceAction $createNewUserBalanceAction)
    {
    }

    public function execute(UserDTO $userDTO): User
    {
        $userAlreadyExists = User::query()->whereUsernameOrEmail($userDTO->username, $userDTO->email)->exists();

        if ($userAlreadyExists) {
            throw new \DomainException(__("A user already exists with this email or username"));
        }

        $user = User::create([
            "username" => $userDTO->username,
            "email" => $userDTO->email,
            "password" => Hash::make($userDTO->password),
            "role" => $userDTO->role
        ]);

        if ($userDTO->role->equals(UserRoleEnum::customer())) {
            $this->createNewUserBalanceAction->execute($user->id);
        }

        return $user;
    }
}
