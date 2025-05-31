<?php

namespace App\Enum;

class MacTypeEnum
{
    public const WHITELIST = 'whitelist';

    public const BLACKLIST = 'blacklist';

    public static function values(): array
    {
        return [
            self::WHITELIST,
            self::BLACKLIST,
        ];
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::values(), true);
    }
}
