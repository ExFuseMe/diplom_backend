<?php

namespace App\Constants;

class RoleConsts
{
    CONST string STUDENT = 'student';
    CONST string PROFORG = 'proforg';
    CONST string ADMIN = 'admin';

    public static function getAll(): array
    {
        return [
            self::ADMIN,
            self::STUDENT,
            self::PROFORG,
        ];
    }
}
