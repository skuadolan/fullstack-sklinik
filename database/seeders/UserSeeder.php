<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        setlocale(LC_TIME, 'id_ID.utf8');

        DB::table('penduduks')->insert([
            'fullname' => 'root'
        ]);

        $id_penduduk = DB::table('penduduks')->max('id');

        DB::table('users')->insert([
            'username' => 'root',
            'email' => 'root@skuad.com',
            'status' => 1,
            'id_role' => 1,
            'id_penduduk' => $id_penduduk,
            'password' => Hash::make('1234'),
            'created_at' => now(env('APP_TIMEZONE', 'UTC'))
        ]);

        $id_user = DB::table('users')->max('id');

        DB::table('pegawais')->insert([
            'id_user' => $id_user,
            'id_penduduk' => $id_penduduk
        ]);
    }
}
