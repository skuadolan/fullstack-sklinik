<?php

namespace App\Http\Controllers;

use Exception;

use App\Traits\Tools;
use App\Traits\ResponseCode;

use Illuminate\Http\JsonResponse;

abstract class ApiController extends Controller
{
    use ResponseCode, Tools;

    public function __construct(private $service) {}

    public function GetAllDatas(object $req): JsonResponse
    {
        try {
            return $this->OKE("Berhasil mengambil data.", $this->service->index($req));
        } catch (Exception $err) {
            return $this->SERVER_ERROR($err->getMessage());
        }
    }

    public function GetDataByParams(object $req): JsonResponse
    {
        try {
            return $this->OKE("Berhasil mengambil data.", $this->service->params($req));
        } catch (Exception $err) {
            return $this->SERVER_ERROR($err->getMessage());
        }
    }

    public function CreateData(object $req): JsonResponse
    {
        try {
            return $this->CREATED("Berhasil menyimpan data.", $this->service->store($req));
        } catch (Exception $err) {
            return $this->SERVER_ERROR($err->getMessage());
        }
    }

    public function GetByID(string $id): JsonResponse
    {
        try {
            return $this->OKE("Berhasil mengambil data.", $this->service->show($id));
        } catch (Exception $err) {
            return $this->SERVER_ERROR($err->getMessage());
        }
    }

    public function UpdateByID(object $req, string $id): JsonResponse
    {
        try {
            return $this->CREATED("Berhasil menyimpan data.", $this->service->update($req, $id));
        } catch (Exception $err) {
            return $this->SERVER_ERROR($err->getMessage());
        }
    }

    public function DeleteByID(string $id): JsonResponse
    {
        try {
            return $this->CREATED("Berhasil menghapus data.", $this->service->delete($id));
        } catch (Exception $err) {
            return $this->SERVER_ERROR($err->getMessage());
        }
    }
}
