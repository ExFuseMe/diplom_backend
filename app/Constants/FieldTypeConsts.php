<?php

namespace App\Constants;

class FieldTypeConsts
{
    const string TEXT = 'text';
    const string NUMBER = 'number';
    const string DATE = 'date';
    const string DATETIME = 'datetime';
    const string SWITCH = 'switch';

    public static function getAll(): array
    {
        return [
            self::TEXT,
            self::NUMBER,
            self::DATE,
            self::DATETIME,
            self::SWITCH,
        ];
    }
}
