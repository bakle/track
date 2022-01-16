<?php

namespace App\Factories;

use App\Constants\ElectronicTypes;
use App\Contracts\ItemFactoryInterface;
use App\Electronics\ElectronicItem;
use App\Exceptions\ItemFactoryException;

class ElectronicItemFactory implements ItemFactoryInterface
{
    public static function createItem(array $item): ElectronicItem
    {
        $name = $item['name'];

        if (!ElectronicTypes::typeExists($name)) {
            throw ItemFactoryException::forUnsupportedType($name);
        }

        /** @var ElectronicItem $item */
        $electronicItem = new (ElectronicTypes::getClassByType($name))();
        $electronicItem->setPrice($item['price']);

        self::setAttributes($item, $electronicItem);

        return $electronicItem;
    }

    private static function setAttributes(array $item, ElectronicItem $electronicItem): void
    {
        if (array_key_exists('attributes', $item)) {
            $electronicItem->setAttributes($item['attributes']);
        }
    }
}
