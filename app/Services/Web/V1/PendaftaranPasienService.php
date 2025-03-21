<?php

namespace App\Services\Web\V1;

use Error;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

use App\Traits\Tools;
use App\Traits\ResponseCode;

use App\Models\Pasien;
use App\Models\Penduduk;
use App\Models\Kunjungan;
use App\Models\Pendaftaran;

class PendaftaranPasienService
{
    use ResponseCode, Tools;
    private $userSession, $userSessionRedis, $dateNow, $selectColmn, $checkForm;
    public function __construct()
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        $this->dateNow = now(env('APP_TIMEZONE', 'Asia/Jakarta'));

        $sessionId = session()->getId();
        $this->userSession = session('user_login');
        $this->userSessionRedis = json_decode(Redis::get("session:$sessionId"), true);

        $this->selectColmn = [
        ];

        $this->checkForm = [
        ];
    }

    public function index()
    {
        try {
            $qry = "SELECT pas.id AS norm, ppas.nik, ppas.fullname, ppas.handphone, ppas.whatsapp, ppas.telegram, ppas.birthdate, ppas.address, gndr.name AS jenis_kelamin, goldar.name AS goldar, ppas.id_provinsi, prov.name AS provinsi, ppas.id_kabupaten, kab.name AS kabupaten, ppas.id_kecamatan, kec.name AS kecamatan, ppas.id_kelurahan, kel.name AS kelurahan FROM PASIEN pas JOIN penduduk ppas ON ppas.id = pas.id_penduduk JOIN GENDER gndr ON gndr.id = ppas.id_gender JOIN GOLONGAN_DARAH goldar ON goldar.id = ppas.id_golongan_darah JOIN PROVINSI prov ON prov.id = ppas.id_provinsi JOIN KABUPATEN kab ON kab.id = ppas.id_kabupaten JOIN KECAMATAN kec ON kec.id = ppas.id_kecamatan JOIN KELURAHAN kel ON kel.id = ppas.id_kelurahan ORDER BY ppas.nama ASC";
            return DB::select("$qry");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function store(Request $req)
    {
        try {
            if (!$this->IsValidAddress($req)) {
                throw new Error("alamat tidak valid");
            }

            $id_user = (isset($this->userSessionRedis['id_user']) ? $this->userSessionRedis['id_user'] : $this->userSession['id_user']);
            $id_client = (isset($this->userSessionRedis['id_client']) ? $this->userSessionRedis['id_client'] : $this->userSession['id_client']);

            DB::beginTransaction();
            if (!$this->isValidVal($req->norm_pasien)) {
                $penduduk = Penduduk::create([
                    'nik' => $req->nik_pasien,
                    'fullname' => $req->nama_pasien,
                    'handphone' => $req->handphone_pasien,
                    'whatsapp' => $req->whatsapp_pasien,
                    'telegram' => $req->telegram_pasien,
                    'birthdate' => $req->tanggal_lahir,
                    'address' => $req->address_pasien,
                    'id_gender' => $req->gender,
                    'id_golongan_darah' => $req->goldar,
                    'id_provinsi' => $req->id_provinsi,
                    'id_kabupaten' => $req->id_kabupaten,
                    'id_kecamatan' => $req->id_kecamatan,
                    'id_kelurahan' => $req->id_kelurahan,
                    'id_user_created' => $id_user,
                    'created_at' => $this->dateNow
                ]);

                $pasien = Pasien::create([
                    'id_penduduk' => $penduduk->id,
                    'id_client' => $id_client,
                    'id_user_created' => $id_user,
                    'created_at' => $this->dateNow
                ]);
            }

            $id_pasien = ($this->IsValidVal($req->norm_pasien) ? $req->norm_pasien : $pasien->id);
            $pendaftaran = Pendaftaran::create([
                'id_pasien' => $id_pasien,
                'id_client' => $id_client,
                'jenis_pasien' => $req->jenis_pasien,
                'id_user_created' => $id_user,
                'created_at' => $this->dateNow
            ]);

            $kunjungan = Kunjungan::create([
                'id_pendaftaran' => $pendaftaran->id,
                // 'id_nakes' => $req->nakes,
                // 'id_bed' => $req->bed,
                'id_pasien' => $id_pasien,
                'waktu_masuk' => $this->dateNow,
                'id_client' => $id_client,
                'id_user_created' => $id_user,
                'created_at' => $this->dateNow
            ]);

            DB::commit();

            return $this->OKE($kunjungan);
        } catch (\Throwable $th) {
            DB::rollBack();

            return $this->SERVER_ERROR($th->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $qry = "SELECT pas.id AS norm, ppas.nik, ppas.fullname, ppas.handphone, ppas.whatsapp, ppas.telegram, ppas.birthdate, ppas.address, gndr.name AS jenis_kelamin, goldar.name AS goldar, ppas.id_provinsi, prov.name AS provinsi, ppas.id_kabupaten, kab.name AS kabupaten, ppas.id_kecamatan, kec.name AS kecamatan, ppas.id_kelurahan, kel.name AS kelurahan FROM PASIEN pas JOIN penduduk ppas ON ppas.id = pas.id_penduduk AND pas.id = $id JOIN GENDER gndr ON gndr.id = ppas.id_gender JOIN GOLONGAN_DARAH goldar ON goldar.id = ppas.id_golongan_darah JOIN PROVINSI prov ON prov.id = ppas.id_provinsi JOIN KABUPATEN kab ON kab.id = ppas.id_kabupaten JOIN KECAMATAN kec ON kec.id = ppas.id_kecamatan JOIN KELURAHAN kel ON kel.id = ppas.id_kelurahan ORDER BY ppas.nama ASC";
            return DB::select("$qry");
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function update(Request $req, string $id)
    {
        try {
            return $this->OKE();
        } catch (\Throwable $th) {
            return $this->SERVER_ERROR($th->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
