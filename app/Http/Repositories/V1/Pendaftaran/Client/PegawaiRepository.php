<?php

namespace App\Http\Repositories\V1\Pendaftaran\Client;

use App\Traits\Tools;

use App\Http\Repositories\Interfaces;

use Illuminate\Support\Facades\DB;

use App\Models\Pendaftaran\Client\Pegawai;

class PegawaiRepository implements Interfaces
{
    use Tools;

    private array $selectColmn = [];
    public function __construct(private $pgwModel = new Pegawai()) {}

    public function store(object $req)
    {
        $newData = $this->pgwModel->SchemaDataModel($req);
        $this->unsetNewDataRecord($newData);
        return DB::table('pegawai')->insertGetId($newData);
    }

    public function index(object $req) {}

    public function show(string $id)
    {
        $rawQry = $this->pgwModel::query();
        $rawQry->select($this->selectColmn)
            ->join('users usr', 'usr.id', '=', 'pegawai.id_user')
            ->join("roles rol", "rol.id", "=", "usr.id_role")
            ->join('list_client lc', 'lc.id', '=', 'usr.id_client')
            ->join('penduduk pdd', 'pdd.id', '=', 'usr.id_penduduk')
            ->join('provinsi prov', 'prov.id', '=', 'pdd.id_provinsi')
            ->join('kabupaten kab', 'kab.id', '=', 'pdd.id_kabupaten')
            ->join('kecamatan kec', 'kec.id', '=', 'pdd.id_kecamatan')
            ->join('kelurahan kel', 'kel.id', '=', 'pdd.id_kelurahan')
            ->leftJoin('profesi prof', 'prof.id', '=', 'pegawai.id_profesi')
            ->where('pegawai.id', $id);

        return $rawQry->first();
    }

    public function update(object $req, string $id) {}

    public function destroy(string $id) {}
}
