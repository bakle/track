<?php

namespace App\Domains\Purchase\Validators;

use App\Constants\ElectronicTypes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PurchaseValidator
{
    public static function validate(array $purchaseInfo)
    {
        Validator::make($purchaseInfo, [
            'purchase' => 'required|array',
            'purchase.*.name' => [
                'required',
                Rule::in(ElectronicTypes::toArray()),
            ],
            'purchase.*.price' => 'required|min:1|numeric',
            'purchase.*.extras' => 'nullable|array',
            'purchase.*.extras.*.name' => [
                'required',
                Rule::in(ElectronicTypes::toArray()),
            ],
            'purchase.*.extras.*.price' => 'required|min:1|numeric',
            'purchase.*.extras.*.attributes' => 'required|array',
            'purchase.*.extras.*.attributes.wired' => 'required|boolean',
        ])->validate();
    }
}
