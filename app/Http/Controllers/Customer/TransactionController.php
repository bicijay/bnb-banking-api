<?php


namespace App\Http\Controllers\Customer;


use App\Http\Controllers\Controller;
use App\Http\Requests\ListTransactionsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function list(ListTransactionsRequest $request): JsonResponse
    {
        $transactions = Auth::user()->transactions()->findByFilters($request->toDTO())->get();
        return response()->json($transactions);
    }
}
