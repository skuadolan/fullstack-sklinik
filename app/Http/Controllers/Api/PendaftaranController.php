<?php

namespace App\Http\Controllers\Api;

use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use App\Models\Pasien;
use App\Models\Pegawai;
use App\Models\Penduduk;
use App\Models\ListClient;
use App\Http\Libraries\Tools;
use App\Models\ClientConfigs;
use App\Http\Libraries\ResponseCode;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class PendaftaranController extends Controller
{
    private $resCode, $tools, $userAgent, $userSession, $userSessionRedis;
    public function __construct()
    {
        $this->tools = new Tools;
        $this->resCode = new ResponseCode;
        $this->userAgent = request()->header('User-Agent');

        $sessionId = session()->getId();
        $this->userSession = session('user_login');
        $this->userSessionRedis = json_decode(Redis::get("session:$sessionId"), true);
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
            $datas = DB::table('pasien AS pas')
                ->selectRaw("pas.id AS norm, ppas.nik, ppas.fullname, ppas.handphone, ppas.whatsapp, ppas.telegram, ppas.birthdate, ppas.address, gndr.name AS jenis_kelamin, goldar.name AS goldar, ppas.id_provinsi, prov.name AS provinsi, ppas.id_kabupaten, kab.name AS kabupaten, ppas.id_kecamatan, kec.name AS kecamatan, ppas.id_kelurahan, kel.name AS kelurahan")
                ->join('penduduk AS ppas', 'ppas.id', '=', 'pas.id_penduduk')
                ->join('gender AS gndr', 'gndr.id', '=', 'ppas.id_gender')
                ->join('golongan_darah AS goldar', 'goldar.id', '=', 'ppas.id_golongan_darah')
                ->join('provinsi AS prov', 'prov.id', '=', 'ppas.id_provinsi')
                ->join('kabupaten AS kab', 'kab.id', '=', 'ppas.id_kabupaten')
                ->join('kecamatan AS kec', 'kec.id', '=', 'ppas.id_kecamatan')
                ->join('kelurahan AS kel', 'kel.id', '=', 'ppas.id_kelurahan')
                ->orderBy('ppas.fullname', 'ASC')
                ->get();
            if ($this->isValidVal($datas)) {
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

            $penduduk = Penduduk::create([
                'nik' => $req->nik_pasien,
                'fullname' => $req->nama_pasien,
                'handphone' => $req->handphone_pasien,
                'whatsapp' => $req->whatsapp_pasien,
                'telegram' => $req->telegram_pasien,
                'birthdate' => $req->tanggal_lahir,
                'address' => $req->alamat,
                'id_gender' => $req->gender,
                'id_golongan_darah' => $req->goldar,
                'id_provinsi' => $req->id_provinsi,
                'id_kabupaten' => $req->id_kabupaten,
                'id_kecamatan' => $req->id_kecamatan,
                'id_kelurahan' => $req->id_kelurahan,
                'created_at' => $dateNow
            ]);

            $pasien = Pasien::create([
                'id_penduduk' => $penduduk->id,
                'id_client' => $this->userSessionRedis['id_client'],
                'created_at' => $dateNow
            ]);

            DB::commit();

            return $this->resCode->CREATED("berhasil menyimpan data", $pasien);
        } catch (ValidationException $th) {
            DB::rollBack();
            return $this->resCode->SERVER_ERROR("kesalahan dalam menyimpan data!", $th->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $pasien = DB::table('pasien')
                ->select('pasien.id AS norm', 'penduduk.nik', 'penduduk.fullname', 'penduduk.handphone', 'penduduk.whatsapp', 'penduduk.telegram', 'penduduk.birthdate', 'penduduk.address', 'gndr.name AS jenis_kelamin', 'goldar.name AS goldar', 'penduduk.id_provinsi', 'prov.name AS provinsi', 'penduduk.id_kabupaten', 'kab.name AS kabupaten', 'penduduk.id_kecamatan', 'kec.name AS kecamatan', 'penduduk.id_kelurahan', 'kel.name AS kelurahan')
                ->join('penduduk', 'penduduk.id', '=', 'pasien.id_penduduk')
                ->join('gender AS gndr', 'gndr.id', '=', 'penduduk.id_gender')
                ->join('golongan_darah AS goldar', 'goldar.id', '=', 'penduduk.id_golongan_darah')
                ->join('provinsi AS prov', 'prov.id', '=', 'penduduk.id_provinsi')
                ->join('kabupaten AS kab', 'kab.id', '=', 'penduduk.id_kabupaten')
                ->join('kecamatan AS kec', 'kec.id', '=', 'penduduk.id_kecamatan')
                ->join('kelurahan AS kel', 'kel.id', '=', 'penduduk.id_kelurahan')
                ->where('pasien.id', $id ?? '')
                ->first();

            if (!$pasien) {
                return $this->resCode->NOT_FOUND("Data pasien tidak ditemukan");
            }

            return $this->resCode->OKE("berhasil mengambil data", $pasien);
        } catch (Exception $e) {
            return $this->resCode->SERVER_ERROR("kesalahan dalam mengambil data!", $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        try {
            $pasien = DB::table('PASIEN')
                ->join('penduduk', 'penduduk.id', '=', 'PASIEN.id_penduduk')
                ->where('PASIEN.id', $id)
                ->select('PASIEN.id', 'penduduk.nik', 'penduduk.fullname', 'penduduk.handphone', 'penduduk.whatsapp', 'penduduk.telegram', 'penduduk.birthdate', 'penduduk.address', 'penduduk.id_gender', 'penduduk.id_golongan_darah', 'penduduk.id_provinsi', 'penduduk.id_kabupaten', 'penduduk.id_kecamatan', 'penduduk.id_kelurahan')
                ->first();

            if (!$pasien) {
                return $this->resCode->NOT_FOUND("Data pasien tidak ditemukan");
            }

            return $this->resCode->OKE("berhasil mengambil data pasien", $pasien);
        } catch (Exception $e) {
            return $this->resCode->SERVER_ERROR("kesalahan dalam mengambil data pasien!", $e->getMessage());
        }
    }

    public function update(Request $req, string $id) {}

    public function destroy(string $id) {}
}
