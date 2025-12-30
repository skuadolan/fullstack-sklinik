<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolDarahSeeder extends Seeder
{
    public function run(): void
    {
        setlocale(LC_TIME, 'id_ID.utf8');

        $datas = [
            [
                "name" => "A"
            ],
            [
                "name" => "B"
            ],
            [
                "name" => "AB"
            ],
            [
                "name" => "O"
            ],
        ];

        DB::table('goldar')->insert($datas);
    }
}
