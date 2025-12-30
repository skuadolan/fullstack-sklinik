<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;

    public function read(array $req): User;

    public function update(array $data, array $req): User;

    public function delete(array $req): User;
}
