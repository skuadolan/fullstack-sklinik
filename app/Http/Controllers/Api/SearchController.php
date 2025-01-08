<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Http\Libraries\Tools;
use App\Http\Libraries\ResponseCode;

class SearchController extends Controller
{
    private $resCode, $tools, $userAgent;
    public function __construct()
    {
        $this->tools = new Tools;
        $this->resCode = new ResponseCode;
        $this->userAgent = request()->header('User-Agent');
    }

    public function index(Request $req)
    {
        try {
            switch ($req->get_data) {
                case 'provinsi':
                    $qry = "SELECT * FROM provinsi prov WHERE LOWER(prov.name) LIKE LOWER('%$req->q%')";
                    $datas = DB::select("$qry");
                    return $this->resCode->OKE("berhasil mengambil data", $datas);
                    break;

                case 'kabupaten':
                    $wheres = ($this->tools->IsValidVal($req->id_provinsi, 'bool') ? " AND kab.id_provinsi = $req->id_provinsi " : " ");
                    $qry = "SELECT * FROM kabupaten kab WHERE LOWER(kab.name) LIKE LOWER('%$req->q%') $wheres";
                    $datas = DB::select("$qry");
                    return $this->resCode->OKE("berhasil mengambil data", $datas);
                    break;

                case 'kecamatan':
                    $wheres = ($this->tools->IsValidVal($req->id_kabupaten, 'bool') ? " AND kec.id_kabupaten = $req->id_kabupaten " : " ");
                    $qry = "SELECT * FROM kecamatan kec WHERE LOWER(kec.name) LIKE LOWER('$req->q%') $wheres";
                    $datas = DB::select("$qry");
                    return $this->resCode->OKE("berhasil mengambil data", $datas);
                    break;

                case 'kelurahan':
                    $wheres = ($this->tools->IsValidVal($req->id_kecamatan, 'bool') ? " AND kel.id_kecamatan = $req->id_kecamatan " : " ");
                    $qry = "SELECT * FROM kelurahan kel WHERE LOWER(kel.name) LIKE LOWER('$req->q%') $wheres";
                    $datas = DB::select("$qry");
                    return $this->resCode->OKE("berhasil mengambil data", $datas);
                    break;

                case 'golongan_darah':
                    $qry = "SELECT * FROM golongan_darah goldar WHERE LOWER(goldar.name) LIKE LOWER('$req->q%')";
                    $datas = DB::select("$qry");
                    return $this->resCode->OKE("berhasil mengambil data", $datas);
                    break;

                default:
                    return $this->resCode->OKE("berhasil mengambil data", []);
                    break;
            }

            return $this->resCode->OKE("tidak ada data");
        } catch (Exception $th) {
            return $this->resCode->SERVER_ERROR("kesalahan dalam mengambil data!", $th->getMessage());
        }
    }
}
