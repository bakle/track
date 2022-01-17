<?php

namespace App\Http\Controllers;

use App\Domains\Purchase\Actions\GeneratePurchaseAction;
use App\Domains\Purchase\Validators\PurchaseValidator;
use App\Helpers\Scenario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function show(Request $request, string $scenario): JsonResponse
    {
        $scenario = Scenario::getScenario($scenario);

        PurchaseValidator::validate($scenario);

        $purchase = GeneratePurchaseAction::execute($scenario['purchase']);

        $items = $purchase->getItems($request->input('filter.type'));

        return response()->json([
            'total_price' => $purchase->getTotalPrice(),
            'items' => $items,
        ]);
    }
}
