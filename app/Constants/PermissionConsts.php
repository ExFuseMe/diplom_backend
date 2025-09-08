<?php

namespace App\Constants;

class PermissionConsts
{
    const array STUDENT_PERMISSIONS = [
        'create answers',
        'view forms',
        'delete answers',
        'approve answer'
    ];
    const array PROFORG_PERMISSIONS = [
        ...self::STUDENT_PERMISSIONS,
        'list answers',
        'list events',
        'create events'
    ];
    const array ADMIN_PERMISSIONS = [
        ...self::PROFORG_PERMISSIONS,
        'create forms',
        'delete forms',
        'update forms',
        'edit answers',
        'delete answers'
    ];

    public static function getAll(): array
    {
        return [
            self::STUDENT_PERMISSIONS,
            self::PROFORG_PERMISSIONS,
            self::ADMIN_PERMISSIONS
        ];
    }

    public static function getPermissionsByRole(string $role = ''): array
    {
        return match ($role){
            RoleConsts::STUDENT => PermissionConsts::STUDENT_PERMISSIONS,
            RoleConsts::PROFORG => PermissionConsts::PROFORG_PERMISSIONS,
            RoleConsts::ADMIN => PermissionConsts::ADMIN_PERMISSIONS,
            default => []
        };
    }
}
