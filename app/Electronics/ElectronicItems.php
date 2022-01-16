<?php

namespace App\Electronics;

use App\Constants\ElectronicTypes;

class ElectronicItems
{
    private array $items = [];

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Returns the items depending on the sorting type requested.
     * @param int $type
     * @return array
     */
    public function getSortedItems(int $type = SORT_NUMERIC): array
    {
        $sorted = [];

        foreach ($this->items as $item) {
            $sorted[($item->getTotalprice() * 100)] = $item;
        }

        ksort($sorted, $type);

        return array_values($sorted);
    }

    /**
     * @param string $type
     * @return array
     */
    public function getItemsByType(string $type): array
    {
        if (!ElectronicTypes::typeExists($type)) {
            return [];
        }

        $callback = function ($item) use ($type) {
            return $item->getType() == $type;
        };

        return array_filter($this->items, $callback);
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
