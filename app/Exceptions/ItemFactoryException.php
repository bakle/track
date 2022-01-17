<?php

namespace App\Exceptions;

use Exception;

class ItemFactoryException extends Exception
{
    public static function forUnsupportedType(string $type): self
    {
        return new self('Item ' . $type . ' does not exist');
    }
}
