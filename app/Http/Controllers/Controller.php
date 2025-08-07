<?php

namespace App\Http\Controllers;

use Exception;

use App\Traits\JsonAPIResponse;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Interfaces;

abstract class Controller implements Interfaces
{
    use JsonAPIResponse;

    private $get = "Berhasil mengambil data!";
    private $delete = "Berhasil menghapus data!", $err = "Gagal memproses request!";
    private $create = "Berhasil membuat data!", $update = "Berhasil memperbarui data!";

    public function __construct(private $service) {}

    public function Create(object $req): JsonResponse
    {
        try {
            $result = $this->service->Create($req);
            return $this->RESPONSE(201, 1, $this->create, $result);
        } catch (Exception $err) {
            return $this->RESPONSE_ERR($err, $this->err);
        }
    }

    public function GetByParams(object $req): JsonResponse
    {
        try {
            $result = $this->service->GetByParams($req);
            return $this->RESPONSE(200, 1, $this->get, $result);
        } catch (Exception $err) {
            return $this->RESPONSE_ERR($err, $this->err);
        }
    }

    public function GetById(string $id): JsonResponse
    {
        try {
            $result = $this->service->GetById($id);
            return $this->RESPONSE(200, 1, $this->get, $result);
        } catch (Exception $err) {
            return $this->RESPONSE_ERR($err, $this->err);
        }
    }

    public function UpdateById(object $req, string $id): JsonResponse
    {
        try {
            $result = $this->service->UpdateById($req, $id);
            return $this->RESPONSE(202, 1, $this->update, $result);
        } catch (Exception $err) {
            return $this->RESPONSE_ERR($err, $this->err);
        }
    }

    public function DeleteById(string $id): JsonResponse
    {
        try {
            $result = $this->service->DeleteById($id);
            return $this->RESPONSE(202, 1, $this->delete, $result);
        } catch (Exception $err) {
            return $this->RESPONSE_ERR($err, $this->err);
        }
    }
}
