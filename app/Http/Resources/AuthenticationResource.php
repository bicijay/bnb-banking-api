<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'token' => $this->createToken("api_token")->plainTextToken,
            'is_admin' => $this->isAdmin(),
        ];
    }
}
