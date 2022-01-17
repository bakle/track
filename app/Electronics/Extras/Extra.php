<?php

namespace App\Electronics\Extras;

use App\Electronics\ElectronicItem;

abstract class Extra extends ElectronicItem
{
    protected ElectronicItem $electronicItem;

    public function setElectronic(ElectronicItem $electronicItem): self
    {
        $this->electronicItem = $electronicItem;

        return $this;
    }
}
