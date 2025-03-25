<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\StarterKit;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Package::factory(10)->create();
        StarterKit::factory(10)->create();
    }
}
