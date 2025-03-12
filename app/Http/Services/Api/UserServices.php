<?php

namespace App\Http\Services\Api;

use Illuminate\Http\Request;
use App\Http\Services\Services;
use App\Http\Requests\Auth\LoginRequest;

use App\Http\Controllers\Api\UserController;

class UserServices extends Services
{
    public function __construct()
    {
        parent::__construct(new UserController);
    }

    public function index()
    {
        return $this->GetAllDatas();
    }

    public function create() {}

    public function store(LoginRequest $req)
    {
        return $this->RegisterData($req);
    }

    public function show(string $id)
    {
        return $this->GetByID($id);
    }

    public function edit(string $id) {}

    public function update(Request $req, string $id) {}

    public function destroy(string $id) {}
}
