<?php


namespace App\Domains\Users\QueryBuilders;


use Illuminate\Database\Eloquent\Builder;

class UserQueryBuilder extends Builder
{
    public function whereUsernameOrEmail(string $username, string $email): self
    {
        return $this->where("username", $username)->orWhere("email", $email);
    }
}
