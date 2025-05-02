<?php

namespace App\Services\V1;

use App\Repositories\V1\UserRepository;

use App\Traits\Tools;

use Illuminate\Support\Facades\Auth;

class UserService
{
    use Tools;

    private $clientService, $pendudukService;
    private $dateNow, $repos, $userSession;
    public function __construct()
    {
        setlocale(LC_TIME, 'id_ID.utf8');

        $this->repos = new UserRepository();

        $this->userSession = session('user_login');
        // $sessionId = session()->getId();
        // $this->userSessionRedis = json_decode(Redis::get("session:$sessionId"), true);
    }

    public function index(object $req)
    {
        return $this->repos->index($req);
    }

    public function store(object $req)
    {
        $id_user = $this->GetUserIDFromRequest($req, $this->userSession);
        $id_user = ($this->IsValidVal($id_user) ? $id_user : Auth::id());
        $id_user = ($this->IsValidVal($id_user) ? $id_user : null);

        $id_client = $this->GetClientIDFromRequest($req, $this->userSession);
        $id_client = ($this->IsValidVal($id_client) ? $id_client : null);

        $data = [
            // List Client
            'klinik_name' => $req->klinik_name,
            'klinik_biography' => $req->klinik_biography,
            // 'id_tier_level' => $req->id_tier_level,

            // Penduduk
            'nik' => $req->nik_user,
            'fullname' => $req->fullname_user,
            'handphone' => $req->handphone_user,
            'whatsapp' => $req->whatsapp_user,
            'telegram' => $req->telegram_user,
            'agama' => $req->agama_user,
            'tempat_lahir' => $req->tempat_lahir_user,
            'birthdate' => $this->ReformatDateTime($req->birthdate_user, true),
            'address' => $req->address,
            'gender' => $req->gender_user,
            'goldar' => $req->goldar_user,
            'id_provinsi' => $req->id_provinsi,
            'id_kabupaten' => $req->id_kabupaten,
            'id_kecamatan' => $req->id_kecamatan,
            'id_kelurahan' => $req->id_kelurahan,

            // User
            'username' => $req->username,
            'email' => $req->email,
            'password' => $req->password,

            'id_profesi' => $req->id_profesi,

            'created_at' => $this->ReformatDateTime($this->dateNow, true),

            'id_client' => $id_client,
            'id_user_created' => $id_user,
        ];

        $data = json_encode($data);
        $data = json_decode($data);
        return $this->repos->store($data);
    }

    public function show(string $id)
    {
        return $this->repos->show($id);
    }

    public function update(object $req, string $id)
    {
        $id_user = $this->GetUserIDFromRequest($req, $this->userSession);
        $id_user = ($this->IsValidVal($id_user) ? $id_user : Auth::id());
        $id_user = ($this->IsValidVal($id_user) ? $id_user : null);

        $id_client = $this->GetClientIDFromRequest($req, $this->userSession);
        $id_client = ($this->IsValidVal($id_client) ? $id_client : null);

        $data = [
            // List Client
            'klinik_name' => $req->klinik_name,
            'klinik_biography' => $req->klinik_biography,
            // 'id_tier_level' => $req->id_tier_level,

            // Penduduk
            'nik' => $req->nik_user,
            'fullname' => $req->fullname_user,
            'handphone' => $req->handphone_user,
            'whatsapp' => $req->whatsapp_user,
            'telegram' => $req->telegram_user,
            'birthdate' => $this->ReformatDateTime($req->birthdate_user, true),
            'address' => $req->address,
            'gender' => $req->gender_user,
            'goldar' => $req->goldar_user,
            'id_provinsi' => $req->id_provinsi,
            'id_kabupaten' => $req->id_kabupaten,
            'id_kecamatan' => $req->id_kecamatan,
            'id_kelurahan' => $req->id_kelurahan,

            // User
            'username' => $req->username,
            'email' => $req->email,
            'password' => $req->password,
            'password_confirmation' => $req->password_confirmation,

            'updated_at' => $this->ReformatDateTime($this->dateNow, true),

            'id_client' => $id_client,
            'id_user_updated' => $id_user,
        ];

        return $this->repos->update($data, $id);
    }

    public function destroy(string $id)
    {
        return $this->repos->destroy($id);
    }
}
