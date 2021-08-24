<?php


namespace App\Domains\Users\DTOs;


use App\Domains\Users\Enums\UserRoleEnum;

class UserDTO
{
    public function __construct(
        public string $username,
        public string $email,
        public string $password,
        public UserRoleEnum $role,
    )
    {
    }
}
