<?php

namespace Database\Seeders;

use App\Constants\PermissionConsts;
use App\Constants\RoleConsts;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = RoleConsts::getAll();

        foreach ($roles as $role) {
            $permissions = PermissionConsts::getPermissionsByRole($role);
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }
            $currentPermissions = Permission::all();
            $userRole = Role::firstOrCreate(['name' => $role]);
            $userRole->givePermissionTo($currentPermissions);
        }
    }
}
