<?php

namespace Database\Seeders;

use App\Constants\RoleConsts;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(10)
            ->create();

        foreach ($users as $user) {
            $user->assignRole(RoleConsts::STUDENT);
        }

        $proforg = User::factory()
            ->create([
                'email' => Config::get('access.seeder_creds.proforg.email'),
                'password' => Config::get('access.seeder_creds.proforg.password')
            ]);
        $proforg->assignRole(RoleConsts::PROFORG);



        $admin = User::factory()
            ->create([
                'email' => Config::get('access.seeder_creds.admin.email'),
                'password' => Config::get('access.seeder_creds.admin.password')
            ]);
        $admin->assignRole(RoleConsts::ADMIN);
    }
}
