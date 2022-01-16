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
        $this->setTotalPrice();
    }

    public function getItems(): array
    {
        return array_map(fn ($item) => $item->toArray(), $this->electronicItems->getSortedItems());
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    private function setTotalPrice(): void
    {
        foreach ($this->electronicItems->getItems() as $item) {
            $this->totalPrice += $item->getTotalPrice();
        }
    }
}
