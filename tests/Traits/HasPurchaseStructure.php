<?php

namespace Tests\Traits;

use App\Constants\ElectronicTypes;

trait HasPurchaseStructure
{
    private function getWiredController(): array
    {
        return [
            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
            'price' => 10.99,
            'is_wired' => true,
        ];
    }

    private function getRemoteController(): array
    {
        return [
            'type' => ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER,
            'price' => 15.3,
            'is_wired' => false,
        ];
    }
}
