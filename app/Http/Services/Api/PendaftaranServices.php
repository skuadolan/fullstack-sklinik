<?php

namespace App\Http\Services\Api;

use Illuminate\Http\Request;
use App\Http\Services\Services;

use App\Http\Controllers\Api\PendaftaranController;

class PendaftaranServices extends Services
{
    public function __construct()
    {
        parent::__construct(new PendaftaranController);
    }

    public function index()
    {
        return $this->GetAllDatas();
    }

    public function create() {}

    public function store(Request $req)
    {
        return $this->SaveData($req);
    }

    public function show(string $id)
    {
        return $this->GetByID($id);
    }

    public function edit(string $id) {}

    public function update(Request $req, string $id) {}

    public function destroy(string $id) {}
}
