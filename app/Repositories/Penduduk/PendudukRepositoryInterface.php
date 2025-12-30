<?php

namespace App\Repositories\Penduduk;

use App\Models\Penduduk;

interface PendudukRepositoryInterface
{
    public function create(array $data): Penduduk;

    public function read(array $req): Penduduk;

    public function update(array $data, array $req): Penduduk;

    public function delete(array $req): Penduduk;
}
