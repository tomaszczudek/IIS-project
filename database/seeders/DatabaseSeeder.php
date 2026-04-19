<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(NakupyModelSeeder::class);
        $this->call(OsetreniModelSeeder::class);
        $this->call(PolozkaModelSeeder::class);
        $this->call(RadkyModelSeeder::class);
        $this->call(SklizenModelSeeder::class);
        $this->call(VinoModelSeeder::class);
        $this->call(UserSeeder::class);
    }
}
