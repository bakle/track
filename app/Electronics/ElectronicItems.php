<?php

namespace App\Electronics;

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

    public function getItemsByType(?string $type = null): array
    {
        if (is_null($type)) {
            return $this->getSortedItems();
        }

        return array_values(
            array_filter($this->getSortedItems(), fn ($item) => $item->getType() == $type)
        );
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
