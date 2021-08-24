<?php


namespace App\Http\Controllers\Admin;


use App\Domains\Deposits\Actions\ReviewDepositAction;
use App\Domains\Deposits\Models\Deposit;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewDepositRequest;
use Illuminate\Http\JsonResponse;

class AdminDepositsController extends Controller
{
    public function find(int $depositId): JsonResponse
    {
        $deposit = Deposit::with(['user', 'image'])->find($depositId);
        return response()->json($deposit);
    }

    public function review(ReviewDepositRequest $request, ReviewDepositAction $reviewDepositAction): JsonResponse
    {
        $reviewedDeposit = $reviewDepositAction->execute($request->toDTO());
        return response()->json($reviewedDeposit);
    }

    public function list(): JsonResponse
    {
        $deposits = Deposit::query()->wherePending()->with("user")->get();
        return response()->json($deposits);
    }
}
