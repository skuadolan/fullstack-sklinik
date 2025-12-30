<?php

namespace App\Repositories\MasterData;

use Illuminate\Http\Request;

interface WilayahInterface
{
    public function getProvinsi();
    public function getKabupaten(Request $req);
    public function getKecamatan(Request $req);
    public function getKelurahan(Request $req);
}
