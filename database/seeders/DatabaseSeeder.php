<?php

namespace Database\Seeders;

use App\Models\Article;
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
        $users = User::factory(10)->create();
        $kits = StarterKit::factory(10)->create();
        $packages = Package::factory(10)->create();

        foreach ($packages as $package) {
            Article::factory(random_int(1, 5))->forModel($package)->create();
        }
    }
}
