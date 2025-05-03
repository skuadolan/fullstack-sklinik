<?php

namespace App\Repositories\V1;

use Illuminate\Support\Facades\DB;

use App\Traits\Tools;

use App\Models\ListClient;

class ClientRepository
{
    use Tools;
    private $selectColmn;
    public function __construct()
    {
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

    public function store(object $req)
    {
        $dataClient = ListClient::SchemaDataModel($req);

        return DB::table('list_clients')->insertGetId($dataClient);
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

    public function update(object $req, string $id)
    {
        $client = ListClient::find($id);

        $data = ListClient::SchemaDataModel($req);
        $data = (object) $data;

        unset($data->created_at);
        unset($data->id_user_created);

        return $client->update($req);
    }

    public function destroy(string $id)
    {
        $client = ListClient::find($id);

        return $client->delete();
    }
}
