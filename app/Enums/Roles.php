<?php

namespace App\Enums;


use Exception;
use Illuminate\Contracts\Translation\Translator;

enum Roles: string
{
    case ROOT = "ROOT";
    case ADMINISTRATOR = "ADMINISTRATOR";
    case USER = "USER";


    /**
     * @throws Exception
     */
    public function description(): string
    {
        return self::getDescription($this);
    }

    /**
     * @param Roles $value
     * @return array|string|Translator
     * @throws Exception
     */
    public static function getDescription(self $value): array|string|Translator
    {
        return match ($value) {
            self::ADMINISTRATOR => __('administrator'),
            self::USER => __('user'),
            default => throw new Exception('Unexpected match value'),
        };
    }
}
