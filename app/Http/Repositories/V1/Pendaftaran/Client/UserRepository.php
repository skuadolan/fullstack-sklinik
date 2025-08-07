<?php

namespace App\Http\Repositories\V1\Pendaftaran\Client;

use App\Traits\Tools;

use App\Http\Repositories\Interfaces;

use Illuminate\Support\Facades\DB;

use App\Models\Pendaftaran\Client\User;

class UserRepository implements Interfaces
{
    use Tools;

    public function __construct(private $usrModel = new User()) {}

    public function store(object $req)
    {
        $newData = $this->usrModel->SchemaDataModel($req);
        $this->unsetNewDataRecord($newData);
        return DB::table('users')->insertGetId($newData);
    }

    public function index(object $req) {}

    public function show(string $id) {}

    public function update(object $req, string $id) {}

    public function destroy(string $id) {}
}
