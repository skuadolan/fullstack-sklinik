<?php

namespace App\Services\V1;

use App\Repositories\V1\UserRepository;

use App\Traits\Tools;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class UserService
{
    use Tools;

    private $repos, $userSession, $userSessionRedis, $dateNow, $selectColmn, $checkForm;
    public function __construct()
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        $this->repos = new UserRepository();

        // $sessionId = session()->getId();
        $this->userSession = session('user_login');
        // $this->userSessionRedis = json_decode(Redis::get("session:$sessionId"), true);
    }

    public function index(object $req)
    {
        return $this->repos->index($req);
    }

    public function store(object $req)
    {
        $id_user = $this->GetUserIDFromRequest($req, $this->userSession);
        $id_client = $this->GetClientIDFromRequest($req, $this->userSession);

        $id_user = ($this->IsValidVal($id_user) ? $id_user : Auth::id());
        $id_client = ($this->IsValidVal($id_client) ? $id_client : null);

        $data = [
            // List Client
            'company_name' => $req->company_name,

            // Penduduk
            'nik' => $req->user_nik,
            'fullname' => $req->fullname,
            'handphone' => $req->handphone,
            'whatsapp' => $req->whatsapp,
            'telegram' => $req->telegram,
            'birthdate' => $this->ReformatDateTime($req->tanggal_lahir, true),
            'address' => $req->address,
            'gender' => $req->gender,
            'goldar' => $req->id_golongan_darah,
            'id_provinsi' => $req->id_provinsi,
            'id_kabupaten' => $req->id_kabupaten,
            'id_kecamatan' => $req->id_kecamatan,
            'id_kelurahan' => $req->id_kelurahan,

            // User
            'username' => $req->username,
            'email' => $req->email,
            'password' => $req->password,
            'password_confirmation' => $req->password_confirmation,

            'id_client' => $id_client,
            'id_user_created' => $id_user,
            'id_user_updated' => $id_user,
        ];

        $data = json_encode($data);
        $data = json_decode($data);
        return $this->repos->store($data);
    }

    public function show(string $id)
    {
        return $this->repos->show($id);
    }

    public function update(object $req, string $id) {}

    public function destroy(string $id) {}
}
