<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Config::set('app.is_seeding', true);
        $this->call([RoleSeeder::class, UserSeeder::class, EventSeeder::class]);
        Config::set('app.is_seeding', true);

    }
}
