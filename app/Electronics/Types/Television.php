<?php

namespace App\Electronics\Types;

use App\Constants\ElectronicTypes;
use App\Electronics\ElectronicItem;

class Television extends ElectronicItem
{
    public function __construct()
    {
        $this->setType(ElectronicTypes::ELECTRONIC_ITEM_TELEVISION);
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getTotalPrice(): float
    {
        $item = $this;

        foreach ($this->extras as $extra) {
            $item = $extra->setElectronic($item);
        }

        return $item->getPrice();
    }
}
