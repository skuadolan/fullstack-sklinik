<?php

namespace App\Http\Controllers\Api;

use Error;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

use App\Http\Traits\Tools;

use App\Models\User;

class UserController extends Controller
{
    use Tools;

    private $dateNow, $selectColmn;
    public function __construct()
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        $this->dateNow = now(env('APP_TIMEZONE', 'Asia/Jakarta'));
        $this->selectColmn = [
            "users.*",
            "rol.name AS role_name",
            "pdd.nik",
            "pdd.fullname",
            "pdd.handphone",
            "pdd.whatsapp",
            "pdd.telegram",
            "pdd.birthdate",
            "pdd.id_gender",
            "pdd.id_golongan_darah",
            "pdd.id_provinsi",
            "pdd.id_kabupaten",
            "pdd.id_kecamatan",
            "pdd.id_kelurahan",
            "pdd.address"
        ];
    }

    private function checkValidation($req)
    {
        $req->validate([
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    }


    public function index()
    {
        return User::select($this->selectColmn)
            ->join("roles AS rol", "rol.id", "=", "users.id_role")
            ->join("penduduk AS pdd", "pdd.id", "=", "users.id_penduduk")
            ->get();
    }

    public function create() {}

    public function store(LoginRequest $req)
    {
        try {
            $expreDate = (clone $this->dateNow)->addDays(30)->toDateTimeString();

            if (strpos($this->UserAgent(), 'Mozilla') !== false) {
                $this->checkValidation($req);
            }

            if (strpos($this->UserAgent(), 'Postman') !== false) {
                $this->checkValidation($req);
            }

            if (!$this->IsValidAddress($req)) {
                throw new Error("alamat tidak valid");
            }

            DB::beginTransaction();

            $id_client = DB::table('list_clients')->insertGetId([
                'name' => $req->company_name,
                'id_provinsi' => $req->id_provinsi,
                'id_kabupaten' => $req->id_kabupaten,
                'id_kecamatan' => $req->id_kecamatan,
                'id_kelurahan' => $req->id_kelurahan,
                'created_at' => $this->dateNow,
                'expired_date' => $expreDate,
            ]);

            // $clientsConfig = ClientConfigs::create([
            //     'id_client' => $listClient->id,
            //     'created_at' => $this->dateNow
            // ]);

            // $clientsConfig->save();

            $id_penduduk = DB::table('penduduk')->insertGetId([
                'fullname' => $req->fullname,
                'created_at' => $this->dateNow
            ]);

            $id_user = DB::table('users')->insertGetId([
                'username' => $req->username,
                'email' => $req->email,
                'password' => Hash::make($req->password),
                'id_client' => $id_client,
                'id_penduduk' => $id_penduduk,
                'expired_date' => $expreDate,
                'created_at' => $this->dateNow
            ]);

            $id_pegawai = DB::table('pegawai')->insertGetId([
                'id_user' => $id_user,
                'id_client' => $id_client,
                'id_penduduk' => $id_penduduk,
                'created_at' => $this->dateNow
            ]);

            DB::commit();

            return $id_pegawai;
        } catch (Error $err) {
            return $err;
        }
    }

    public function show(string $id)
    {
        return User::select($this->selectColmn)
            ->join('roles AS rol', 'rol.id', '=', 'users.id_role')
            ->join('penduduk AS pdd', 'pdd.id', '=', 'users.id_penduduk')
            ->find($id);
    }

    public function edit(string $id) {}

    public function update(Request $req, string $id) {}

    public function destroy(string $id) {}
}
