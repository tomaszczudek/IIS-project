<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RadkyModel;

class RadkyModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RadkyModel::query()->insert([
            [
                'odruda_enum' => 1,
                'pocet_hlav' => 100,
                'rok_vysadby' => 1850,
            ],
            [
                'odruda_enum' => 2,
                'pocet_hlav' => 150,
                'rok_vysadby' => 1990,
            ],
            [
                'odruda_enum' => 3,
                'pocet_hlav' => 200,
                'rok_vysadby' => 2000,
            ],
            [
                'odruda_enum' => 4,
                'pocet_hlav' => 100,
                'rok_vysadby' => 2020,
            ],
            [
                'odruda_enum' => 5,
                'pocet_hlav' => 150,
                'rok_vysadby' => 2019,
            ],
            [
                'odruda_enum' => 6,
                'pocet_hlav' => 200,
                'rok_vysadby' => 2021,
            ],
        ]);
    }
}
