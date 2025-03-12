<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;

use App\Http\Traits\Tools;
use App\Http\Traits\ResponseCode;

abstract class Services
{
    use ResponseCode, Tools;

    private $repo;
    public function __construct($Repo)
    {
        $this->repo = new $Repo;
    }

    public function GetAllDatas()
    {
        try {
            $datas = $this->repo->index();

            return ($this->IsValidVal($datas) ? $this->OKE($datas) : $this->OKE(null, "Tidak ada data!"));
        } catch (Exception $err) {
            return $this->SERVER_ERROR($err->getMessage());
        }
    }

    public function create() {}

    public function SaveData(Request $req)
    {
        try {
            $datas = $this->repo->store($req);

            return ($this->IsValidVal($datas) ? $this->CREATED($datas) : $this->BAD_REQUEST(null, "Tidak ada data!"));
        } catch (Exception $err) {
            return $this->SERVER_ERROR($err->getMessage());
        }
    }

    public function RegisterData(LoginRequest $req)
    {
        try {
            $datas = $this->repo->store($req);

            return ($this->IsValidVal($datas) ? $this->CREATED($datas) : $this->BAD_REQUEST(null, "Tidak ada data!"));
        } catch (Exception $err) {
            return $this->SERVER_ERROR($err->getMessage());
        }
    }

    public function GetByID(string $id)
    {
        try {
            $datas = $this->repo->show($id);

            return ($this->IsValidVal($datas) ? $this->OKE($datas) : $this->OKE(null, "Tidak ada data!"));
        } catch (Exception $err) {
            return $this->SERVER_ERROR($err->getMessage());
        }
    }

    public function edit(string $id) {}

    public function update(Request $req, string $id) {}

    public function destroy(string $id) {}
}
