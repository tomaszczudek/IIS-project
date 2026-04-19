<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NakupyModel;

class NakupyModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NakupyModel::query()->insert([
            [
                'user_id' => 1,
                'datum_nakupu' => '2024-01-15',
                'stav' => 3
            ],
            [
                'user_id' => 1,
                'datum_nakupu' => '2024-02-10',
                'stav' => 0
            ],
            [
                'user_id' => 2,
                'datum_nakupu' => '2024-02-20',
                'stav' => 1
            ],
            [
                'user_id' => 2,
                'datum_nakupu' => '2024-03-05',
                'stav' => 0
            ]
        ]);
    }
}