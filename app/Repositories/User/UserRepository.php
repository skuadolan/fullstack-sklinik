<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User { return User::create($data); }

    public function read(array $req): User { return User::find($req); }

    public function update(array $data, array $req): User { return User::find($req)->update($data); }

    public function delete(array $req): User { return User::find($req)->delete(); }
}
