<?php

namespace App\Electronics;

use App\Electronics\Extras\Extra;

abstract class ElectronicItem
{
    protected float $price = 0;
    protected array $extras = [];
    private string $type = '';
    private bool $wired = false;

    abstract public function getPrice(): float;

    abstract protected function maxExtras(): ?int;

    public function toArray(): array
    {
        $data = [
            'type' => $this->type,
            'price' => $this->price,
            'is_wired' => $this->wired,
        ];

        if ($this->hasExtras()) {
            $data['extras'] = $this->getExtras();
        }

        return $data;
    }

    public function setAttributes(array $attributes): void
    {
        if (array_key_exists('wired', $attributes) && !is_null($attributes['wired'])) {
            $this->setWired((bool)$attributes['wired']);
        }
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function setExtra(Extra $extra)
    {
        if ($this->cannotHaveExtras()) {
            return;
        }

        $this->extras[] = $extra;
    }

    public function getExtras(): array
    {
        return array_map(fn ($item) => $item->toArray(), $this->extras);
    }

    public function getWired(): bool
    {
        return $this->wired;
    }

    protected function setWired(bool $wired): void
    {
        $this->wired = $wired;
    }

    private function hasExtras(): bool
    {
        return !empty($this->extras);
    }

    private function cannotHaveExtras(): bool
    {
        return is_null($this->maxExtras()) || ($this->maxExtras() >= 0 && count($this->extras) >= $this->maxExtras());
    }
}
