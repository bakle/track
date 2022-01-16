<?php

namespace App\Http\Controllers;

use App\Domains\Purchase\Actions\CreatePurchaseAction;
use App\Domains\Purchase\Requests\PurchaseRequest;

class PurchaseController extends Controller
{
    public function store(PurchaseRequest $request)
    {
        $purchase = CreatePurchaseAction::execute($request->input('purchase'));

        return response()->json([
            'total_price' => $purchase->getTotalPrice(),
            'items' => $purchase->getItems(),
        ]);
    }
}
