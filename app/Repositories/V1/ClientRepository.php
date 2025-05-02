<?php

namespace App\Repositories\V1;

use Error;

use Illuminate\Support\Facades\DB;

use App\Traits\Tools;
use App\Traits\ResponseCode;

use App\Models\ListClient;

class ClientRepository
{
    use ResponseCode, Tools;
    private $dateNow, $selectColmn;
    public function __construct()
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        $this->dateNow = now(env('APP_TIMEZONE', 'Asia/Jakarta'));

        $this->selectColmn = [
            "list_clients.*",
            "prov.name AS provinsi",
            "kab.name AS kabupaten",
            "kec.name AS kecamatan",
            "kel.name AS kelurahan"
        ];
    }

    public function index($req = null)
    {
        $rawQry = ListClient::query();
        if ($req->filled('get_data')) { // Nama Kolom yang mau di car by
            $params = strtolower($req->input('params'));
            $colName = strtolower($req->input('get_data'));

            $rawQry->select($this->selectColmn)
                ->join('provinsi AS prov', 'prov.id', '=', 'list_clients.id_provinsi')
                ->join('kabupaten AS kab', 'kab.id', '=', 'list_clients.id_kabupaten')
                ->join('kecamatan AS kec', 'kec.id', '=', 'list_clients.id_kecamatan')
                ->join('kelurahan AS kel', 'kel.id', '=', 'list_clients.id_kelurahan')
                ->where(function ($qryI) use ($colName, $params) {
                    $qryI->whereRaw("LOWER($colName) LIKE ?", ["%$params%"]);
                });
        }

        $sortable = [
            "id",
            "name",
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

    public function store(array $req)
    {
        return DB::table('list_clients')->insertGetId($req);
    }

    public function show(string $id)
    {
        return ListClient::select($this->selectColmn)
            ->join('provinsi AS prov', 'prov.id', '=', 'list_clients.id_provinsi')
            ->join('kabupaten AS kab', 'kab.id', '=', 'list_clients.id_kabupaten')
            ->join('kecamatan AS kec', 'kec.id', '=', 'list_clients.id_kecamatan')
            ->join('kelurahan AS kel', 'kel.id', '=', 'list_clients.id_kelurahan')
            ->find($id);
    }

    public function update(array $req, string $id)
    {
        $user = ListClient::find($id);
        return $user->update($req);
    }

    public function destroy(string $id)
    {
        $user = ListClient::find($id);
        return $user->delete();
    }
}
