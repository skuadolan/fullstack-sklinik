<?php

namespace App\Repositories\Penduduk;

use App\Models\Penduduk;
use App\Repositories\Penduduk\PendudukRepositoryInterface;

class PendudukRepository implements PendudukRepositoryInterface
{
    public function create(array $data): Penduduk { return Penduduk::create($data); }

    public function read(array $req): Penduduk { return Penduduk::find($req); }

    public function update(array $data, array $req): Penduduk { return Penduduk::find($req)->update($data); }

    public function delete(array $req): Penduduk { return Penduduk::find($req)->delete(); }
}
