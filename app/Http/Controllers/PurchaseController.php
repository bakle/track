<?php

namespace App\Http\Controllers;

use App\Domains\Purchase\Actions\GeneratePurchaseAction;
use App\Domains\Purchase\Requests\PurchaseRequest;
use App\Helpers\Scenario;
use Illuminate\Http\JsonResponse;

class PurchaseController extends Controller
{
    public function show(PurchaseRequest $request): JsonResponse
    {
        $scenario = Scenario::getScenario($request->input('scenario'));

        $purchase = GeneratePurchaseAction::execute($scenario['purchase']);

        $items = $purchase->filterByType($request->input('filter.type'));

        return response()->json([
            'total_price' => $purchase->getTotalPrice(),
            'items' => $items,
        ]);
    }
}
