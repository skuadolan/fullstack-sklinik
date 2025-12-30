<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class KelurahanSeeder extends Seeder
{
    public function run(): void
    {
        ini_set('memory_limit', '256M');
        setlocale(LC_TIME, 'id_ID.utf8');

        $jsonPath = database_path("seeders/wilayah_idn/kelurahan.json");
        $jsonDataKels = File::get($jsonPath);
        $kels = json_decode($jsonDataKels, true);

        foreach (array_chunk($kels, 1000) as $chunk) {
            $arryDatas = [];
            foreach ($chunk as $kel) {
                $arryDatas[] = [
                    "id" => $kel['id'],
                    "name" => $kel['name'],
                    "postal_code" => $kel['pos_code'],
                    "code" => $kel['code'],
                    "full_code" => $kel['full_code'],
                    "id_kecamatan" => $kel['kecamatan_id'],
                ];
            }
            DB::table('kelurahan')->insert($arryDatas);
        }
    }
}
