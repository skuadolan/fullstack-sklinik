<?php

namespace App\Http\Controllers\Api\V1\Pendaftaran;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Http\Controllers\Controller;

use App\Http\Requests\Api\UserRequest;
use App\Http\Services\V1\Pendaftaran\Client\ClientService;

class ClientController extends Controller
{
    public function __construct(private $service = new ClientService()) { parent::__construct($this->service); }

    public function store(UserRequest $req): JsonResponse { return $this->Create($req); }

    public function index(Request $req): JsonResponse { return $this->GetByParams($req); }

    public function show(string $id): JsonResponse { return $this->GetByID($id); }

    public function update(UserRequest $req, string $id): JsonResponse { return $this->UpdateByID($req, $id); }

    public function destroy(string $id): JsonResponse { return $this->DeleteByID($id); }
}
