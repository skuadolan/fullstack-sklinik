<?php

namespace App\Services\V1;

use App\Traits\Tools;

use App\Repositories\V1\PendudukRepository;

class PendudukService
{
    use Tools;

    private $dateNow, $repos, $userSession;
    public function __construct()
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        $this->dateNow = now(env('APP_TIMEZONE', 'Asia/Jakarta'));

        $this->repos = new PendudukRepository();

        $this->userSession = session('user_login');
        // $sessionId = session()->getId();
        // $this->userSessionRedis = json_decode(Redis::get("session:$sessionId"), true);
    }

    public function index($req)
    {
        return $this->repos->index($req);
    }

    public function store(object $req)
    {
        $data = [
            'nik' => $req->nik,
            'fullname' => $req->fullname,
            'handphone' => $req->handphone,
            'whatsapp' => $req->whatsapp,
            'telegram' => $req->telegram,
            'birthdate' => $this->ReformatDateTime($req->birthdate, true),
            'agama' => $req->agama,
            'tempat_lahir' => $req->tempat_lahir,
            'goldar' => $req->goldar,
            'gender' => $req->gender,
            'id_provinsi' => $req->id_provinsi,
            'id_kabupaten' => $req->id_kabupaten,
            'id_kecamatan' => $req->id_kecamatan,
            'id_kelurahan' => $req->id_kelurahan,
            'address' => $req->address,
            'created_at' => $this->ReformatDateTime($this->dateNow, true),
        ];

        return $this->repos->store($data);
    }

    public function show(string $id)
    {
        return $this->repos->show($id);
    }

    public function update(object $req, string $id)
    {
        $data = [
            'nik' => $req->nik,
            'fullname' => $req->fullname,
            'handphone' => $req->handphone,
            'whatsapp' => $req->whatsapp,
            'telegram' => $req->telegram,
            'birthdate' => $this->ReformatDateTime($req->birthdate, true),
            'goldar' => $req->goldar,
            'gender' => $req->gender,
            'agama' => $req->agama,
            'tempat_lahir' => $req->tempat_lahir,
            'id_provinsi' => $req->id_provinsi,
            'id_kabupaten' => $req->id_kabupaten,
            'id_kecamatan' => $req->id_kecamatan,
            'id_kelurahan' => $req->id_kelurahan,
            'address' => $req->address,
            'updated_at' => $this->ReformatDateTime($this->dateNow, true),
            'id_user_updated' => $this->GetUserIDFromRequest($req, $this->userSession),
        ];

        return $this->repos->update($data, $id);
    }

    public function destroy(string $id)
    {
        return $this->repos->destroy($id);
    }
}
