<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SklizenModel;

class SklizenModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SklizenModel::query()->insert([
            [
                'radek_id' => 1,
                'hmotnost_hroznu_kg' => 150.50,
                'litry_vina' => 120.50,
                'odruda_hroznu' => 1,
                'cukernatost_hroznu' => 22.50,
                'datum_sklizne' => '2023-10-15',
            ],
            [
                'radek_id' => 2,
                'hmotnost_hroznu_kg' => 180.75,
                'litry_vina' => 140,
                'odruda_hroznu' => 2,
                'cukernatost_hroznu' => 23.30,
                'datum_sklizne' => '2023-10-16',
            ],
            [
                'radek_id' => 3,
                'hmotnost_hroznu_kg' => 165.20,
                'litry_vina' => 130,
                'odruda_hroznu' => 1,
                'cukernatost_hroznu' => 21.80,
                'datum_sklizne' => '2023-10-17',
            ],
        ]);
    }
}
