<?php

namespace App\Services;

use App\Repositories\MasterData\WilayahInterface;

use Illuminate\Http\Request;

class SearchService
{
    public function __construct(
        protected WilayahInterface $wilayahRepos
    ) {}

    public function getProvinsi() {
        return $this->wilayahRepos->getProvinsi();
    }
    
    public function getKabupaten(Request $req) {
        return $this->wilayahRepos->getKabupaten($req);
    }

    public function getKecamatan(Request $req) {
        return $this->wilayahRepos->getKecamatan($req);
    }

    public function getKelurahan(Request $req) {
        return $this->wilayahRepos->getKelurahan($req);
    }
}
