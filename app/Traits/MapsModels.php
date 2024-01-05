<?php

namespace App\Traits;

use App\Models\Vote;
use App\Models\Follow;
use App\Models\Comment;

trait MapsModels
{
    public static function isClassName(string $name): bool
    {
        return str_contains($name, 'App\\Models\\');
    }

    public static function mapToCodeName(string $className): ?string
    {
        return empty($className) ?
            null : (self::isClassName($className)
                ? substr(strrchr($className, '\\'), 1)
                : $className
            );
    }

    public static function mapToClassName(string $codeName): ?string
    {
        return self::isClassName($codeName)
            ? $codeName
            : 'App\\Models\\'.$codeName;
    }

    public static function canMapToComment(string $name, bool $isCodeName): bool
    {
        if ($isCodeName) {
            $name = self::mapToClassName($name);
        }

        return ! in_array($name, [
            Comment::class,
            Follow::class,
            Vote::class,
        ]);
    }
}
