<?php

namespace App\Http\Repositories\V1\Pendaftaran;

use App\Traits\Tools;

use App\Http\Repositories\Interfaces;

use Illuminate\Support\Facades\DB;

use App\Models\Pendaftaran\Penduduk;

class PendudukRepository implements Interfaces
{
    use Tools;

    public function __construct(private $pddModel = new Penduduk()) {}

    public function store(object $req)
    {
        $newData = $this->pddModel->SchemaDataModel($req);
        $this->unsetNewDataRecord($newData);
        return DB::table('penduduk')->insertGetId($newData);
    }

    public function index(object $req) {}

    public function show(string $id) {}

    public function update(object $req, string $id) {}

    public function destroy(string $id) {}
}
