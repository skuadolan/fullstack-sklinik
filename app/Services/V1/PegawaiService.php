<?php

namespace App\Services\V1;

use App\Traits\Tools;

use App\Repositories\V1\PegawaiRepository;

class PegawaiService
{
    use Tools;

    private $dateNow, $repos, $userSession;
    public function __construct()
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        $this->dateNow = now(env('APP_TIMEZONE', 'Asia/Jakarta'));

        $this->repos = new PegawaiRepository();

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
            'id_user' => $req->id_user,
            'id_profesi' => $req->id_profesi,
            'id_penduduk' => $req->id_penduduk,
            'id_client' => $req->id_client,
            'created_at' => $this->ReformatDateTime($this->dateNow, true)
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
            'id_user' => $req->id_user,
            'id_profesi' => $req->id_profesi,
            'id_penduduk' => $req->id_penduduk,
            'id_client' => $req->id_client,
            'updated_at' => $this->ReformatDateTime($this->dateNow, true)
        ];

        return $this->repos->update($data, $id);
    }

    public function destroy(string $id)
    {
        return $this->repos->destroy($id);
    }
}
