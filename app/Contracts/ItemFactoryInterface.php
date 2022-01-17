<?php

namespace App\Contracts;

interface ItemFactoryInterface
{
    public static function createItem(array $item);
}
