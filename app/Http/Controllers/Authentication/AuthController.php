<?php


namespace App\Http\Controllers\Authentication;


use App\Domains\Authentication\Actions\LoginUserAction;
use App\Domains\Authentication\Actions\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\AuthenticationResource;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request, RegisterUserAction $registerUserAction): AuthenticationResource
    {
        return new AuthenticationResource(
            $registerUserAction->execute($request->toDTO())
        );
    }

    public function login(LoginUserRequest $request, LoginUserAction $loginUserAction): AuthenticationResource
    {
        return new AuthenticationResource(
            $loginUserAction->execute($request->toDTO())
        );
    }
}
