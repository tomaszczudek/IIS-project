<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PolozkaModel;

class PolozkaModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PolozkaModel::query()->insert([
            [
                'nakup_id' => 1,
                'vino_id' => 1,
                'pocet_lahvi' => 6,
            ],
            [
                'nakup_id' => 1,
                'vino_id' => 2,
                'pocet_lahvi' => 12,
            ],
            [
                'nakup_id' => 2,
                'vino_id' => 3,
                'pocet_lahvi' => 6,
            ],
            [
                'nakup_id' => 3,
                'vino_id' => 1,
                'pocet_lahvi' => 12,
            ],
            [
                'nakup_id' => 4,
                'vino_id' => 4,
                'pocet_lahvi' => 6,
            ],
            [
                'nakup_id' => 4,
                'vino_id' => 2,
                'pocet_lahvi' => 12,
            ],
        ]);
    }
}
