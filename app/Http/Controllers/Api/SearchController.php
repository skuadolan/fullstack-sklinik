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
                    $wheres = ($this->tools->IsValidVal($req->q) ? "  WHERE LOWER(prov.name) LIKE LOWER('%$req->q%') " : "");
                    $qry = "SELECT prov.id, prov.name FROM provinsi prov $wheres ORDER BY prov.name ASC";
                    $datas = DB::select("$qry");
                    return $this->resCode->OKE("berhasil mengambil data", $datas);
                    break;

                case 'kabupaten':
                    $wheres = ($this->tools->IsValidVal($req->q) ? " WHERE LOWER(kab.name) LIKE LOWER('%$req->q%') " : "");
                    $wheres = ($this->tools->IsValidVal($req->id_provinsi) && !$this->tools->IsValidVal($wheres) ? " WHERE kab.id_provinsi = $req->id_provinsi " : " $wheres AND kab.id_provinsi = $req->id_provinsi ");
                    $qry = "SELECT kab.id, kab.name, kab.type FROM kabupaten kab $wheres ORDER BY kab.name ASC";
                    $datas = DB::select("$qry");
                    return $this->resCode->OKE("berhasil mengambil data", $datas);
                    break;

                case 'kecamatan':
                    $wheres = ($this->tools->IsValidVal($req->q) ? " WHERE LOWER(kec.name) LIKE LOWER('%$req->q%') " : "");
                    $wheres = ($this->tools->IsValidVal($req->id_kabupaten) && !$this->tools->IsValidVal($wheres) ? " WHERE kec.id_kabupaten = $req->id_kabupaten " : " $wheres AND kec.id_kabupaten = $req->id_kabupaten ");
                    $qry = "SELECT kec.id, kec.name FROM kecamatan kec $wheres ORDER BY kec.name ASC";
                    $datas = DB::select("$qry");
                    return $this->resCode->OKE("berhasil mengambil data", $datas);
                    break;

                case 'kelurahan':
                    $wheres = ($this->tools->IsValidVal($req->q) ? " WHERE LOWER(kel.name) LIKE LOWER('%$req->q%') " : "");
                    $wheres = ($this->tools->IsValidVal($req->id_kecamatan) && !$this->tools->IsValidVal($wheres) ? " WHERE kel.id_kecamatan = $req->id_kecamatan " : " $wheres AND kel.id_kecamatan = $req->id_kecamatan ");
                    $qry = "SELECT kel.id, kel.name, kel.postal_code FROM kelurahan kel $wheres ORDER BY kel.name ASC";
                    $datas = DB::select("$qry");
                    return $this->resCode->OKE("berhasil mengambil data", $datas);
                    break;

                case 'golongan_darah':
                    $qry = "SELECT goldar.id, goldar.name FROM golongan_darah goldar WHERE LOWER(goldar.name) LIKE LOWER('$req->q%')";
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
