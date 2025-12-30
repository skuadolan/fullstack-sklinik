<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProvinsiSeeder extends Seeder
{
    public function run(): void
    {
        setlocale(LC_TIME, 'id_ID.utf8');

        $jsonPath = database_path('seeders/wilayah_idn/provinsi.json');
        $jsonData = File::get($jsonPath);
        $provs = json_decode($jsonData, true);

        $arryDatas = [];
        foreach ($provs as $prov) {
            $data = ['id' => $prov['id'], 'code' => $prov['code'], 'name' => $prov['name']];
            array_push($arryDatas, $data);
        }

        DB::table('provinsi')->insert($arryDatas);
    }
}
