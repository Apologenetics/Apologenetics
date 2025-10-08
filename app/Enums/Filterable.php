<?php

namespace App\Enums;

use App\Models;
use App\Traits\MapsModels;

enum Filterable: string
{
    use MapsModels;

    case All = 'all';
    case Nugget = Models\Nugget::class;
    case Doctrine = Models\Doctrine::class;
    case User = Models\User::class;
        // case Church = Models\Church::class;
    case Religion = Models\Religion::class;
    case Denomination = Models\Denomination::class;

    public static function fromString(string $string): ?self
    {
        return self::tryFrom(
            static::mapToClassName(ucfirst($string))
        );
    }

    public static function fromClassName(string $class): ?self
    {
        return static::isClassName($class)
            ? self::tryFrom($class)
            : null;
    }
}
