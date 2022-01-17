<?php

namespace App\Electronics\Extras;

use App\Constants\ElectronicTypes;
use App\Traits\HasNullableExtras;

class Controller extends Extra
{
    use HasNullableExtras;

    public function __construct()
    {
        $this->setType(ElectronicTypes::ELECTRONIC_ITEM_CONTROLLER);
    }

    public function getPrice(): float
    {
        return $this->electronicItem->getPrice() + $this->price;
    }
}
