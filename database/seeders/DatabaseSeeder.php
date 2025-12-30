<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        try {
            $this->call([
                ICDSeeder::class,
                RoleSeeder::class,
                TierSeeder::class,
                UserSeeder::class,
                RuanganSeeder::class,
                HeaderMainMenu::class,
                GolDarahSeeder::class,
                ProvinsiSeeder::class,
                KabupatenSeeder::class,
                KecamatanSeeder::class,
                KelurahanSeeder::class,
            ]);
        } catch (Exception $err) {
            throw $err;
        }
    }
}
