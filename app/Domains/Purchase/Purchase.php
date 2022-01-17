<?php

namespace App\Domains\Purchase;

use App\Electronics\ElectronicItems;

class Purchase
{
    private ElectronicItems $electronicItems;
    private float $totalPrice = 0;

    public function __construct(array $items)
    {
        $this->electronicItems = new ElectronicItems($items);
    }

    public function getItems(?string $type = null): array
    {
        $items = $this->electronicItems->getItemsByType($type);

        $this->refreshFilteredItems($items);

        return array_map(fn ($item) => $item->toArray(), $items);
    }

    public function getTotalPrice(): float
    {
        foreach ($this->electronicItems->getItems() as $item) {
            $this->totalPrice += $item->getTotalPrice();
        }

        return round($this->totalPrice, 2);
    }

    private function refreshFilteredItems(array $items): void
    {
        $this->electronicItems = new ElectronicItems($items);
    }
}
