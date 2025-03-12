<?php

namespace App\Http\Controllers\Web;

use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

use App\Http\Libraries\Tools;
use App\Http\Libraries\ResponseCode;

use App\Models\Visit;
use App\Models\Pasien;
use App\Models\Penduduk;
use App\Models\Kunjungan;

class PendaftaranController extends Controller
{
    private $resCode, $tools, $userAgent, $userSession, $userSessionRedis;
    public function __construct()
    {
        $this->tools = new Tools;
        $this->resCode = new ResponseCode;
        $this->userAgent = request()->header('User-Agent');
    }

    private function reformatDBDateTime($val, $format = "d-m-Y H:i:s", $toDB = false) {
        return $this->tools->reformatDBDateTime($val, $format, $toDB);
    }

    private function isValidVal($val, $get = ["bool", "value", "equal"], $other = null, $key = null) {
        return $this->tools->isValidVal($val, $get, $other, $key);
    }

    private function isValidAddress($req) {
        return $this->tools->isValidAddress($req);
    }

    public function index()
    {
        try {
            $qry = "SELECT pas.id AS norm, ppas.nik, ppas.fullname, ppas.handphone, ppas.whatsapp, ppas.telegram, ppas.birthdate, ppas.address, gndr.name AS jenis_kelamin, goldar.name AS goldar, ppas.id_provinsi, prov.name AS provinsi, ppas.id_kabupaten, kab.name AS kabupaten, ppas.id_kecamatan, kec.name AS kecamatan, ppas.id_kelurahan, kel.name AS kelurahan FROM PASIEN pas JOIN penduduk ppas ON ppas.id = pas.id_penduduk JOIN GENDER gndr ON gndr.id = ppas.id_gender JOIN GOLONGAN_DARAH goldar ON goldar.id = ppas.id_golongan_darah JOIN PROVINSI prov ON prov.id = ppas.id_provinsi JOIN KABUPATEN kab ON kab.id = ppas.id_kabupaten JOIN KECAMATAN kec ON kec.id = ppas.id_kecamatan JOIN KELURAHAN kel ON kel.id = ppas.id_kelurahan ORDER BY ppas.nama ASC";
            $datas = DB::select("$qry");
            if ($this->IsValidVal($datas)) {
                return $this->resCode->OKE("berhasil mengambil data", $datas);
            }
            return $this->resCode->OKE("tidak ada data");
        } catch (Exception $th) {
            return $this->resCode->SERVER_ERROR("kesalahan dalam mengambil data!", $th->getMessage());
        }
    }

    public function create() {}

    public function store(Request $req)
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        $dateNow = now(env('APP_TIMEZONE', 'Asia/Jakarta'));

        try {
            if (!$this->isValidAddress($req)) {
                throw new Error("alamat tidak valid");
            }

            DB::beginTransaction();
            if (!$this->isValidVal($req->norm_pasien)) {
                $penduduk = Penduduk::create([
                    'nik' => $req->nik_pasien,
                    'fullname' => $req->nama_pasien,
                    'handphone' => $req->handphone_pasien,
                    'whatsapp' => $req->whatsapp_pasien,
                    'telegram' => $req->telegram_pasien,
                    'birthdate' => $this->reformatDBDateTime($req->tanggal_lahir, null, true),
                    'address' => $req->address_pasien,
                    'id_gender' => $req->gender,
                    'id_golongan_darah' => $req->goldar,
                    'id_provinsi' => $req->id_provinsi,
                    'id_kabupaten' => $req->id_kabupaten,
                    'id_kecamatan' => $req->id_kecamatan,
                    'id_kelurahan' => $req->id_kelurahan,
                    'id_user_created' => $req->id_user,
                    'created_at' => $dateNow
                ]);

                $pasien = Pasien::create([
                    'id_penduduk' => $penduduk->id,
                    'id_client' => $req->id_client,
                    'id_user_created' => $req->id_user,
                    'created_at' => $dateNow
                ]);
            }

            $id_pasien = ($this->isValidVal($req->norm_pasien) ? $req->norm_pasien : $pasien->id);
            $visit = Visit::create([
                'id_pasien' => $id_pasien,
                'id_client' => $req->id_client,
                'id_user_created' => $req->id_user,
                'created_at' => $dateNow
            ]);

            $kunjungan = Kunjungan::create([
                'id_visit' => $visit->id,
                // 'id_nakes' => $req->nakes,
                // 'id_bed' => $req->bed,
                'id_pasien' => $id_pasien,
                'waktu_masuk' => $dateNow,
                'id_client' => $req->id_client,
                'id_user_created' => $req->id_user,
                'created_at' => $dateNow
            ]);

            DB::commit();

            return $this->resCode->CREATED("berhasil menyimpan data", $visit);
        } catch (ValidationException $th) {
            DB::rollBack();
            return $this->resCode->SERVER_ERROR("kesalahan dalam menyimpan data!", $th->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $wheres = ($this->IsValidVal($id) ? " WHERE pas.id = $id AND " : "");
            $qry = "SELECT pas.id AS norm, ppas.nik, ppas.fullname, ppas.handphone, ppas.whatsapp, ppas.telegram, ppas.birthdate, ppas.address, gndr.name AS jenis_kelamin, goldar.name AS goldar, ppas.id_provinsi, prov.name AS provinsi, ppas.id_kabupaten, kab.name AS kabupaten, ppas.id_kecamatan, kec.name AS kecamatan, ppas.id_kelurahan, kel.name AS kelurahan FROM PASIEN pas JOIN penduduk ppas ON ppas.id = pas.id_penduduk JOIN GENDER gndr ON gndr.id = ppas.id_gender JOIN GOLONGAN_DARAH goldar ON goldar.id = ppas.id_golongan_darah JOIN PROVINSI prov ON prov.id = ppas.id_provinsi JOIN KABUPATEN kab ON kab.id = ppas.id_kabupaten JOIN KECAMATAN kec ON kec.id = ppas.id_kecamatan JOIN KELURAHAN kel ON kel.id = ppas.id_kelurahan $wheres ";
            $datas = DB::select("$qry");
            if ($this->IsValidVal($datas)) {
                return $this->resCode->OKE("berhasil mengambil data", $datas);
            }
            return $this->resCode->OKE("tidak ada data");
        } catch (Exception $th) {
            return $this->resCode->SERVER_ERROR("kesalahan dalam mengambil data!", $th->getMessage());
        }
    }

    public function edit(string $id) {}

    public function update(Request $req, string $id) {}

    public function destroy(string $id) {}
}
