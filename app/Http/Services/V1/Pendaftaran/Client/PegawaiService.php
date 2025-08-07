<?php

namespace App\Http\Services\V1\Pendaftaran\Client;

use App\Http\Services\Interfaces;

use App\Http\Repositories\V1\Pendaftaran\Client\PegawaiRepository;

class PegawaiService implements Interfaces
{
    public function __construct(private $repos = new PegawaiRepository()) {}

    public function Create(object $req) { return $this->repos->store($req); }

    public function GetByParams(object $req) { return $this->repos->index($req); }

    public function GetById(string $id) { return $this->repos->show($id); }

    public function UpdateById(object $req, string $id) { return $this->repos->update($req, $id); }

    public function DeleteById(string $id) { return $this->repos->destroy($id); }
}
