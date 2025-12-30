<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        setlocale(LC_TIME, 'id_ID.utf8');

        $datas = [
            [
                "name" => "IGD / UGD",
                "jenis_unit" => "Rawat Darurat"
            ],
        ];

        DB::table('unit')->insert($datas);
    }
}
