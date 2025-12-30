<?php

namespace App\Http\Controllers\Sections;

use App\Services\SearchService;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function __construct(protected SearchService $service) {}

    public function getProvinsi(): JsonResponse
    {
        try {
            $datas = $this->service->getProvinsi();
            return $this->apiJsonResponse(201, "Data berhasil diambil", $datas);
        } catch (Exception $err) {
            return $this->apiJsonResponse(400, "Data gagal diambil", $err->getMessage());
        }
    }

    public function getKabupaten(Request $req): JsonResponse
    {
        try {
            $datas = $this->service->getKabupaten($req);
            return $this->apiJsonResponse(201, "Data berhasil diambil", $datas);
        } catch (Exception $err) {
            return $this->apiJsonResponse(400, "Data gagal diambil", $err->getMessage());
        }
    }

    public function getKecamatan(Request $req): JsonResponse
    {
        try {
            $datas = $this->service->getKecamatan($req);
            return $this->apiJsonResponse(201, "Data berhasil diambil", $datas);
        } catch (Exception $err) {
            return $this->apiJsonResponse(400, "Data gagal diambil", $err->getMessage());
        }
    }

    public function getKelurahan(Request $req): JsonResponse
    {
        try {
            $datas = $this->service->getKelurahan($req);
            return $this->apiJsonResponse(201, "Data berhasil diambil", $datas);
        } catch (Exception $err) {
            return $this->apiJsonResponse(400, "Data gagal diambil", $err->getMessage());
        }
    }
}
