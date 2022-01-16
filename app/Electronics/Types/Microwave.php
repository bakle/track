<?php

namespace App\Electronics\Types;

use App\Constants\ElectronicTypes;
use App\Electronics\ElectronicItem;

class Microwave extends ElectronicItem
{
    public function __construct()
    {
        $this->setType(ElectronicTypes::ELECTRONIC_ITEM_MICROWAVE);
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getTotalPrice(): float
    {
        return $this->getPrice();
    }
}
