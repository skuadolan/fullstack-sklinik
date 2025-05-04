<?php

namespace App\Repositories\V1;

use Error;

use App\Services\V1\ClientService;
use App\Services\V1\PegawaiService;
use App\Services\V1\PendudukService;

use App\Traits\Tools;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    use Tools;
    private $selectColmn;
    private $clientService, $pendudukService, $pegawaiService;
    public function __construct()
    {
        $this->selectColmn = [
            "users.*",
            "rol.name AS role_name",
            "pdd.nik",
            "pdd.fullname",
            "pdd.handphone",
            "pdd.whatsapp",
            "pdd.telegram",
            "pdd.birthdate",
            "pdd.gender",
            "pdd.goldar",
            "prov.name AS provinsi",
            "kab.name AS kabupaten",
            "kec.name AS kecamatan",
            "kel.name AS kelurahan",
            "pdd.address"
        ];

        $this->clientService = new ClientService();
        $this->pegawaiService = new PegawaiService();
        $this->pendudukService = new PendudukService();
    }

    public function index($req = null)
    {
        $rawQry = User::query();
        if ($req->filled('get_data')) { // Nama Kolom yang mau di car by
            $params = strtolower($req->input('params'));
            $colName = strtolower($req->input('get_data'));

            $rawQry->select($this->selectColmn)
                ->join('provinsi AS prov', 'prov.id', '=', 'list_clients.id_provinsi')
                ->join('kabupaten AS kab', 'kab.id', '=', 'list_clients.id_kabupaten')
                ->join('kecamatan AS kec', 'kec.id', '=', 'list_clients.id_kecamatan')
                ->join('kelurahan AS kel', 'kel.id', '=', 'list_clients.id_kelurahan')
                ->join("roles AS rol", "rol.id", "=", "users.id_role")
                ->join("penduduk AS pdd", "pdd.id", "=", "users.id_penduduk")
                ->where(function ($qryI) use ($colName, $params) {
                    $qryI->whereRaw("LOWER($colName) LIKE ?", ["%$params%"]);
                });
        }

        $sortable = [
            "id",
            "username",
            "fullname",
            "role_name",
            "provinsi",
            "kabupaten",
            "kecamatan",
            "kelurahan",
            "created_at",
        ];
        $sortBy = (in_array($req->input('sort_by'), $sortable) ? $req->input('sort_by') : "id");
        $sorting = (in_array($req->input('sorting'), ['asc', 'desc']) ? $req->input('sorting') : "asc");

        $rawQry->orderBy($sortBy, $sorting);

        return $rawQry->get();
    }

    public function store(object $req)
    {
        DB::beginTransaction();
        $req->id_client = $this->clientService->store($req);
        $req->id_penduduk = $this->pendudukService->store($req);

        $dataUsr = User::SchemaDataModel($req);

        unset($dataUsr['id_user_created']);

        $req->id_user = DB::table('users')->insertGetId($dataUsr);

        $id_pegwai = $this->pegawaiService->store($req);

        $pegwai = $this->pegawaiService->show($id_pegwai);

        if ($this->IsValidVal($pegwai)) {
            DB::commit();
            return $pegwai;
        } else {
            DB::rollBack();
            return new Error("Kesalahan insert ke database");
        }
    }

    public function show(string $id)
    {
        return User::select($this->selectColmn)
            ->join('roles AS rol', 'rol.id', '=', 'users.id_role')
            ->join('penduduk AS pdd', 'pdd.id', '=', 'users.id_penduduk')
            ->find($id);
    }

    public function update(object $req, string $id) {
        $user = User::find($id);

        if ($this->IsValidVal($user->id)) {
            DB::beginTransaction();
            $this->pendudukService->update($req, $user->id_penduduk);

            $data = User::SchemaDataModel($req);
            $data = (object) $data;

            unset($data->created_at);
            unset($data->id_user_created);

            $result = $user->update($data);

            if ($this->IsValidVal($result)) {
                DB::commit();
                return $result;
            } else {
                DB::rollBack();
                return new Error("Kesalahan update ke database");
            }
        }

        return $user;
    }

    public function destroy(string $id) {}
}
