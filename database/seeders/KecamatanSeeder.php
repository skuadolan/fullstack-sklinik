<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class KecamatanSeeder extends Seeder
{
    public function run(): void
    {
        setlocale(LC_TIME, 'id_ID.utf8');

        $jsonPath = database_path("seeders/wilayah_idn/kecamatan.json");
        $jsonDataKecs = File::get($jsonPath);
        $kecs = json_decode($jsonDataKecs, true);

        $chunk_kec = array_chunk($kecs, 1000);
        foreach ($chunk_kec as $kec_chunk) {
            $datas = [];
            foreach ($kec_chunk as $kec) {
                $datas[] = [
                    "id" => $kec['id'],
                    "name" => $kec['name'],
                    "code" => $kec['code'],
                    "full_code" => $kec['full_code'],
                    "id_kabupaten" => $kec['kabupaten_id'],
                ];
            }
            DB::table('kecamatan')->insert($datas);
        }
    }
}
