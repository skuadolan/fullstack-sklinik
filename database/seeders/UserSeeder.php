<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        $dateNow = now(env('APP_TIMEZONE', 'Asia/Jakarta'));

        $id_penduduk = DB::table('penduduk')->insertGetId([
            'first_name' => 'root',
            'last_name' => 'admin',
            'fullname' => 'root',
            'gender' => 'Laki - Laki',
            'pendidikan' => 'Tidak Diketahui',
            'pekerjaan' => 'Tidak Diketahui',
            'status_pernikahan' => 'Tidak Diketahui',
            'created_at' => $dateNow
        ]);

        $id_user = DB::table('users')->insertGetId([
            'username' => 'root',
            'email' => 'root@skuad.com',
            'id_role' => 1,
            'id_penduduk' => $id_penduduk,
            'password' => Hash::make('1234'),
            'created_at' => $dateNow
        ]);

        DB::table('pegawai')->insert([
            'id_user' => $id_user,
            'created_at' => $dateNow
        ]);
    }
}
