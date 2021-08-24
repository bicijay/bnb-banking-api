<?php


namespace App\Http\Controllers\Customer;

use App\Domains\Purchases\Actions\CreateNewPurchaseAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePurchaseRequest;
use App\Http\Requests\ListPurchasesRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function list(ListPurchasesRequest $request): JsonResponse
    {
        $purchasesList = Auth::user()->purchases()->findByFilters($request->toDTO())->get();
        return response()->json($purchasesList);
    }

    public function create(CreatePurchaseRequest $request, CreateNewPurchaseAction $createNewPurchaseAction): JsonResponse
    {
        $createdPurchase = $createNewPurchaseAction->execute($request->toDTO());
        return response()->json($createdPurchase);
    }
}
