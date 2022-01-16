<?php

namespace App\Domains\Purchase\Actions;

use App\Domains\Purchase\Purchase;
use App\Electronics\ElectronicItem;
use App\Factories\ElectronicItemFactory;

class CreatePurchaseAction
{
    public static function execute(array $purchase): Purchase
    {
        $electronicItems = [];

        foreach ($purchase as $item) {
            $electronicItem = ElectronicItemFactory::createItem($item);
            self::setExtras($item, $electronicItem);

            $electronicItems[] = $electronicItem;
        }

        return new Purchase($electronicItems);
    }

    private static function setExtras(array $item, ElectronicItem $electronicItem)
    {
        if (array_key_exists('extras', $item) && !is_null($item['extras'])) {
            foreach ($item['extras'] as $extraItem) {
                $extra = ElectronicItemFactory::createItem($extraItem);
                $electronicItem->setExtra($extra);
            }
        }
    }
}
