<?php

namespace App\Repositories\MasterData;

use App\Models\MasterData\Wilayah\Provinsi;
use App\Models\MasterData\Wilayah\Kabupaten;
use App\Models\MasterData\Wilayah\Kecamatan;
use App\Models\MasterData\Wilayah\Kelurahan;

use App\Repositories\MasterData\WilayahInterface;

use Illuminate\Support\Facades\Cache;

class WilayahRepository implements WilayahInterface
{
    protected int $ttlRedis = 60 * 60 * 3; // 1 menit -> mencari 1 jam -> * 3 jam = total detik

    public function getProvinsi() {
        return Cache::remember('provinsi:all', $this->ttlRedis, function () {
            return Provinsi::orderBy('name')->get();
        });
    }

    public function getKabupaten($req) {
        $id_provinsi = $req->id_provinsi;

        return Cache::remember("kabupaten:provinsi:{$id_provinsi}", $this->ttlRedis, function () use ($id_provinsi) {
            return Kabupaten::where('id_provinsi', $id_provinsi)->orderBy('name')->get();
        });
    }

    public function getKecamatan($req) {
        $id_kabupaten = $req->id_kabupaten;

        return Cache::remember("kecamatan:kabupaten:{$id_kabupaten}", $this->ttlRedis, function () use ($id_kabupaten) {
            return Kecamatan::where('id_kabupaten', $id_kabupaten)->orderBy('name')->get();
        });
    }

    public function getKelurahan($req) {
        $id_kecamatan = $req->id_kecamatan;

        return Cache::remember("kelurahan:kecamatan:{$id_kecamatan}", $this->ttlRedis, function () use ($id_kecamatan) {
            return Kelurahan::where('id_kecamatan', $id_kecamatan)->orderBy('name')->get();
        });
    }
}
