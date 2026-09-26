<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {

            // DB::beginTransaction();

            // User::factory(10)->create();

            // User::factory()->create([
            //     'name' => 'Test User',
            //     'email' => 'test@example.com',
            // ]);

            $this->call([
                \Database\Seeders\Master\RegionSeeder::class,
            ]);

            // DB::commit();

        } catch (\Exception $err) {
            // DB::rollBack();

            dd($err->getMessage());
        }
    }
}
