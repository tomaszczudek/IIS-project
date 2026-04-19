<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OsetreniModel;

class OsetreniModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OsetreniModel::query()->insert([
            [
                'radky_id' => 1,
                'datum' => '2025-03-15',
                'typ_enum' => 1,
                'postrik_typ' => null,
                'koncentrace' => null,
                'poznamka' => 'První ošetření na jaře',
            ],
            [
                'radky_id' => 2,
                'datum' => '2025-12-11',
                'typ_enum' => 2,
                'postrik_typ' => null,
                'koncentrace' => null,
                'poznamka' => 'Prevence proti škůdcům',
            ],
            [
                'radky_id' => 3,
                'datum' => '2025-12-12',
                'typ_enum' => 3,
                'postrik_typ' => "wd-40",
                'koncentrace' => 60,
                'poznamka' => 'Prevence proti rezu',
            ],
        ]);
    }
}
