<?php
namespace App\Http\Controllers\Api\MasterData;

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

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $resCode, $tools, $userAgent, $userSession, $userSessionRedis;
    public function __construct()
    {
        $this->resCode = new ResponseCode();
        $this->tools = new Tools();

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
        $penduduk = \App\Models\Penduduk::select('id', 'nik', 'fullname', 'handphone', 'whatsapp', 'telegram', 'birthdate', 'address')
            ->orderBy('fullname', 'asc')
            ->get();
        return $this->resCode->OKE("berhasil mengambil data", $penduduk);

    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $req)
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        $dateNow = now(env('APP_TIMEZONE', 'Asia/Jakarta'));

        try {
            // if (!$this->isValidAddress($req)) {
            //     throw new Error("alamat tidak valid");
            // }

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

            DB::commit();

            return $this->resCode->CREATED("berhasil menyimpan data", $penduduk);
        } catch (ValidationException $th) {
            DB::rollBack();
            return $this->resCode->SERVER_ERROR("kesalahan dalam menyimpan data!", $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penduduk = \App\Models\Penduduk::select('id', 'nik', 'fullname', 'handphone', 'whatsapp', 'telegram', 'birthdate', 'address')
            ->where('id', $id)
            ->first();

        if (!$penduduk) {
            return $this->resCode->NOT_FOUND("Data penduduk tidak ditemukan");
        }

        return $this->resCode->OKE("berhasil mengambil data", $penduduk);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
