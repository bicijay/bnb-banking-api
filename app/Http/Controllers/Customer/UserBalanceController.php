<?php


namespace App\Http\Controllers\Customer;


use App\Domains\Transactions\Models\UserBalance;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class UserBalanceController extends Controller
{
    public function show(): JsonResponse
    {
        $userBalance = UserBalance::query()->findByUserId(\Auth::id());
        return response()->json($userBalance);
    }
}
