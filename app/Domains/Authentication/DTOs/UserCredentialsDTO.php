<?php


namespace App\Domains\Authentication\DTOs;


class UserCredentialsDTO
{
    public function __construct(
        public string $username,
        public string $password,
        public ?string $email = null,
    )
    {
    }
}
