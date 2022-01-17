<?php

namespace App\Constants;

use App\Electronics\Extras\Controller;
use App\Electronics\Types\Console;
use App\Electronics\Types\Microwave;
use App\Electronics\Types\Television;
use ReflectionClass;

final class ElectronicTypes
{
    public const ELECTRONIC_ITEM_TELEVISION = 'television';
    public const ELECTRONIC_ITEM_CONSOLE = 'console';
    public const ELECTRONIC_ITEM_MICROWAVE = 'microwave';
    public const ELECTRONIC_ITEM_CONTROLLER = 'controller';

    public static function typeExists(string $type): bool
    {
        return in_array($type, self::toArray());
    }

    public static function toArray(): array
    {
        return (new ReflectionClass(self::class))->getConstants();
    }

    public static function getClassByType(string $type): string
    {
        return self::getClassesByTypes()[$type];
    }

    private static function getClassesByTypes(): array
    {
        return [
            self::ELECTRONIC_ITEM_TELEVISION => Television::class,
            self::ELECTRONIC_ITEM_CONSOLE => Console::class,
            self::ELECTRONIC_ITEM_MICROWAVE => Microwave::class,
            self::ELECTRONIC_ITEM_CONTROLLER => Controller::class,
        ];
    }
}
