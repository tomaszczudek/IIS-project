<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VinoModel;

class VinoModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VinoModel::query()->insert([
            [
                'sklizen_id' => 1,
                'rocnik' => 2023,
                'odruda' => 1,
                'procento_alkoholu' => 11.50,
                'pocet_vyrobenych_lahvi' => 500,
                'pocet_zbylych_lahvi' => 450,
                'datum_lahvovani' => '2024-03-20',
                'cena' => 250.00
            ],
            [
                'sklizen_id' => 1,
                'rocnik' => 2023,
                'odruda' => 2,
                'procento_alkoholu' => 12.00,
                'pocet_vyrobenych_lahvi' => 400,
                'pocet_zbylych_lahvi' => 380,
                'datum_lahvovani' => '2024-03-21',
                'cena' => 300.00
            ],
            [
                'sklizen_id' => 2,
                'rocnik' => 2023,
                'odruda' => 3,
                'procento_alkoholu' => 13.50,
                'pocet_vyrobenych_lahvi' => 550,
                'pocet_zbylych_lahvi' => 520,
                'datum_lahvovani' => '2024-03-22',
                'cena' => 280.00
            ],
            [
                'sklizen_id' => 3,
                'rocnik' => 2023,
                'odruda' => 4,
                'procento_alkoholu' => 12.50,
                'pocet_vyrobenych_lahvi' => 480,
                'pocet_zbylych_lahvi' => 460,
                'datum_lahvovani' => '2024-03-23',
                'cena' => 270.00
            ],

            [
                'sklizen_id' => 0,
                'rocnik' => 2023,
                'odruda' => 2,
                'procento_alkoholu' => 14.00,
                'pocet_vyrobenych_lahvi' => 600,
                'pocet_zbylych_lahvi' => 590,
                'datum_lahvovani' => '2024-03-24',
                'cena' => 320.00
            ]
        ]);
    }
}