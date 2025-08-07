<?php

namespace App\Http\Controllers\Api\V1;

use Exception;

use App\Traits\JsonAPIResponse;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

use App\Services\Api\V1\SearchService;

class SearchController extends Controller
{
    use JsonAPIResponse;

    private $get = "Berhasil mengambil data!", $err = "Gagal memproses request!";

    public function __construct(private SearchService $service) {}

    public function SearchWilayah(Request $req): JsonResponse
    {
        try {
            $result = $this->service->getWilayah($req);
            return $this->RESPONSE(201, 1, $this->get, $result);
        } catch (Exception $err) {
            return $this->RESPONSE_ERR($err, $this->err);
        }
    }

    public function SearchRoles(Request $req): JsonResponse
    {
        try {
            $result = $this->service->getRoles($req);
            return $this->RESPONSE(201, 1, $this->get, $result);
        } catch (Exception $err) {
            return $this->RESPONSE_ERR($err, $this->err);
        }
    }

    public function SearchUsers(Request $req): JsonResponse
    {
        try {
            $result = $this->service->getUsers($req);
            return $this->RESPONSE(201, 1, $this->get, $result);
        } catch (Exception $err) {
            return $this->RESPONSE_ERR($err, $this->err);
        }
    }

    public function SearchPasien(Request $req): JsonResponse
    {
        try {
            $result = $this->service->getPasien($req);
            return $this->RESPONSE(201, 1, $this->get, $result);
        } catch (Exception $err) {
            return $this->RESPONSE_ERR($err, $this->err);
        }
    }

    public function SearchRajal(Request $req): JsonResponse
    {
        try {
            $result = $this->service->getRajal($req);
            return $this->RESPONSE(201, 1, $this->get, $result);
        } catch (Exception $err) {
            return $this->RESPONSE_ERR($err, $this->err);
        }
    }

    public function SearchRanap(Request $req): JsonResponse
    {
        try {
            $result = $this->service->getRanap($req);
            return $this->RESPONSE(201, 1, $this->get, $result);
        } catch (Exception $err) {
            return $this->RESPONSE_ERR($err, $this->err);
        }
    }

    public function SearchKunjunganPasienByID(Request $req): JsonResponse
    {
        try {
            $result = $this->service->getKunjunganPasienByID($req);
            return $this->RESPONSE(201, 1, $this->get, $result);
        } catch (Exception $err) {
            return $this->RESPONSE_ERR($err, $this->err);
        }
    }
}
