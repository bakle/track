<?php

namespace App\Traits;

trait HasNullableExtras
{
    protected function maxExtras(): ?int
    {
        return null;
    }
}
