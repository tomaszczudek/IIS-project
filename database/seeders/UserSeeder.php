<?php

namespace Database\Seeders;

use App\Enums\UserGroupEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->insert([
            [
                'name' => "Testovací Zákazník #1",
                'email' => "zakaznik1@seznam.cz",
                'password' => Hash::make("Zakaznik11"),
                'group' => UserGroupEnum::CUSTOMER,
                'created_at' => now()
            ],
            [
                'name' => "Testovací Zákazník #2",
                'email' => "zakaznik2@seznam.cz",
                'password' => Hash::make("Zakaznik12"),
                'group' => UserGroupEnum::CUSTOMER,
                'created_at' => now()
            ],
            [
                'name' => "Testovací Zaměstnanec #1",
                'email' => "zamestnanec1@seznam.cz",
                'password' => Hash::make("Zamestnanec11"),
                'group' => UserGroupEnum::WORKER,
                'created_at' => now()
            ],
            [
                'name' => "Testovací Zaměstnanec #2",
                'email' => "zamestnanec2@seznam.cz",
                'password' => Hash::make("Zamestnanec11"),
                'group' => UserGroupEnum::WORKER,
                'created_at' => now()
            ],
            [
                'name' => "Testovací Vinař #1",
                'email' => "vinar1@seznam.cz",
                'password' => Hash::make("Vinar11"),
                'group' => UserGroupEnum::WINEMAKER,
                'created_at' => now()
            ],
            [
                'name' => "Testovací Vinař #2",
                'email' => "vinar2@seznam.cz",
                'password' => Hash::make("Vinar12"),
                'group' => UserGroupEnum::WINEMAKER,
                'created_at' => now()
            ]
        ]);
    }
}
