<?php

namespace App\Enums;

use App\Models;
use App\Traits\MapsModels;

enum Filterable: string {
    use MapsModels;

    case All = 'all';
    case Nugget = Nugget::class;
    case Doctrine = Doctrine::class;
    case User = User::class;
    case Church = Church::class;
    case Religion = Religion::class;
    case Denomination = Denomination::class;

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
