<?php

namespace App\Repositories\V1;

use Error;

use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Traits\Tools;
use App\Traits\ResponseCode;

use App\Models\User;
use App\Models\Penduduk;

use App\Http\Requests\Api\UserRequest;

class UserRepository
{
    use ResponseCode, Tools;
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
            "pdd.gender",
            "pdd.goldar",
            "pdd.id_provinsi",
            "pdd.id_kabupaten",
            "pdd.id_kecamatan",
            "pdd.id_kelurahan",
            "pdd.address"
        ];
    }

    public function index($req = null)
    {
        return User::select($this->selectColmn)
            ->join("roles AS rol", "rol.id", "=", "users.id_role")
            ->join("penduduk AS pdd", "pdd.id", "=", "users.id_penduduk")
            ->get();
    }

    public function store(object $req)
    {
        try {
            $expreDate = (clone $this->dateNow)->addDays(30)->toDateTimeString();

            if (!$this->IsValidAddress($req)) {
                throw new Error("Alamat tidak valid");
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

            // Harusnya disini ada insert ke Clients Config terkait Tier Level

            $dataPenduduk = Penduduk::whereNotNull('nik')->where('nik', $req->nik)->first();

            if (!$this->IsValidVal($dataPenduduk)) {
                $id_penduduk = DB::table('penduduk')->insertGetId([
                    'nik' => $req->nik,
                    'fullname' => $req->fullname,
                    'handphone' => $req->handphone,
                    'whatsapp' => $req->whatsapp,
                    'telegram' => $req->telegram,
                    'birthdate' => $req->birthdate,
                    'address' => $req->address,
                    'gender' => $req->gender,
                    'id_golongan_darah' => $req->goldar,
                    'id_provinsi' => $req->id_provinsi,
                    'id_kabupaten' => $req->id_kabupaten,
                    'id_kecamatan' => $req->id_kecamatan,
                    'id_kelurahan' => $req->id_kelurahan,
                    'created_at' => $this->dateNow
                ]);
            }

            $id_penduduk = (isset($dataPenduduk->id)) ? $dataPenduduk->id : $id_penduduk;

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

            return $this->OKE($id_pegawai);
        } catch (ValidationException $err) {
            DB::rollBack();

            return $this->SERVER_ERROR($err->errors());
        }
    }

    public function show(string $id)
    {
        return User::select($this->selectColmn)
            ->join('roles AS rol', 'rol.id', '=', 'users.id_role')
            ->join('penduduk AS pdd', 'pdd.id', '=', 'users.id_penduduk')
            ->find($id);
    }

    public function update(object $req, string $id)
    {
        try {
            $user = User::find($id);
            $penduduk = Penduduk::find($user->id_penduduk);

            if (!$this->IsValidAddress($req)) {
                return $this->NOT_FOUND("Alamat tidak valid!");
            }

            DB::beginTransaction();

            $user->update([
                'username' => $req->username,
                'email' => $req->email,
                'password' => Hash::make($req->password),
                'updated_at' => $this->dateNow
            ]);

            $penduduk->update([
                'nik' => $req->nik,
                'fullname' => $req->nama,
                'handphone' => $req->handphone,
                'whatsapp' => $req->whatsapp,
                'telegram' => $req->telegram,
                'birthdate' => $this->ReformatDateTime($req->tanggal_lahir, true),
                'address' => $req->address,
                'id_gender' => $req->gender,
                'id_golongan_darah' => $req->goldar,
                'id_provinsi' => $req->id_provinsi,
                'id_kabupaten' => $req->id_kabupaten,
                'id_kecamatan' => $req->id_kecamatan,
                'id_kelurahan' => $req->id_kelurahan,
                'id_user_updated' => $req->id_user_updated,
                'updated_at' => $this->dateNow
            ]);

            if ($this->IsValidVal($penduduk) || $this->IsValidVal($user)) {
                DB::commit();
            } else {
                DB::rollBack();
                throw new ValidationException("Gagal update data penduduk/user");
            }
        } catch (ValidationException $err) {
            return $this->SERVER_ERROR($err->errors());
        }
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        return $user->delete();
    }
}
