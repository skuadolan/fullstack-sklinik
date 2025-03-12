<?php

namespace App\Http\Controllers\Api;

use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Http\Traits\Tools;

use App\Models\Visit;
use App\Models\Pasien;
use App\Models\Penduduk;
use App\Models\Kunjungan;

class PendaftaranController extends Controller
{
    use Tools;

    private $dateNow, $selectColmn;
    public function __construct()
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        $this->dateNow = now(env('APP_TIMEZONE', 'Asia/Jakarta'));
    }

    public function index()
    {
    }

    public function create() {}

    public function store(Request $req)
    {
        try {
            if (!$this->IsValidAddress($req)) {
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
                    'birthdate' => $this->ReformatDateTime($req->tanggal_lahir, null, true),
                    'address' => $req->address_pasien,
                    'id_gender' => $req->gender,
                    'id_golongan_darah' => $req->goldar,
                    'id_provinsi' => $req->id_provinsi,
                    'id_kabupaten' => $req->id_kabupaten,
                    'id_kecamatan' => $req->id_kecamatan,
                    'id_kelurahan' => $req->id_kelurahan,
                    'id_user_created' => $req->id_user,
                    'created_at' => $this->dateNow
                ]);

                $pasien = Pasien::create([
                    'id_penduduk' => $penduduk->id,
                    'id_client' => $req->id_client,
                    'id_user_created' => $req->id_user,
                    'created_at' => $this->dateNow
                ]);
            }

            $id_pasien = ($this->isValidVal($req->norm_pasien) ? $req->norm_pasien : $pasien->id);
            $visit = Visit::create([
                'id_pasien' => $id_pasien,
                'id_client' => $req->id_client,
                'id_user_created' => $req->id_user,
                'created_at' => $this->dateNow
            ]);

            $kunjungan = Kunjungan::create([
                'id_visit' => $visit->id,
                // 'id_nakes' => $req->nakes,
                // 'id_bed' => $req->bed,
                'id_pasien' => $id_pasien,
                'waktu_masuk' => $this->dateNow,
                'id_client' => $req->id_client,
                'id_user_created' => $req->id_user,
                'created_at' => $this->dateNow
            ]);

            DB::commit();

            return $kunjungan;
        } catch (Error $err) {
            DB::rollBack();
            return $err;
        }
    }

    public function show(string $id)
    {
    }

    public function edit(string $id) {}

    public function update(Request $req, string $id) {}

    public function destroy(string $id) {}
}
