<?php


namespace App\Http\Controllers\Customer;


use App\Domains\Deposits\Actions\CreateNewDepositAction;
use App\Http\Requests\CreateDepositRequest;
use App\Http\Requests\ListDepositsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class DepositController
{
    public function find(int $depositId): JsonResponse
    {
        $deposit = Auth::user()->deposits()->find($depositId);
        return response()->json($deposit);
    }

    public function create(CreateDepositRequest $request, CreateNewDepositAction $createNewDepositAction): JsonResponse
    {
        $createdDeposit = $createNewDepositAction->execute($request->toDTO());
        return response()->json($createdDeposit);
    }

    public function list(ListDepositsRequest $request): JsonResponse
    {
        $depositsList = Auth::user()->deposits()->findByFilters($request->toDTO())->get();
        return response()->json($depositsList);
    }
}
