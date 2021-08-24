<?php


namespace App\Domains\Authentication\Actions;


use App\Domains\Authentication\DTOs\UserCredentialsDTO;
use App\Domains\Users\Actions\CreateNewUserAction;
use App\Domains\Users\DTOs\UserDTO;
use App\Domains\Users\Enums\UserRoleEnum;
use App\Domains\Users\Models\User;

class RegisterUserAction
{
    public function __construct(private CreateNewUserAction $createNewUserAction)
    {
    }

    public function execute(UserCredentialsDTO $userCredentialsDTO): User
    {
        $userDTO = new UserDTO(
            $userCredentialsDTO->username,
            $userCredentialsDTO->email,
            $userCredentialsDTO->password,
            UserRoleEnum::customer(), //new users are registered as customers
        );

        return $this->createNewUserAction->execute($userDTO);
    }
}
