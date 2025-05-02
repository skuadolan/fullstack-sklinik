<?php

namespace App\Services\V1;

use App\Traits\Tools;

use App\Repositories\V1\ClientRepository;

class ClientService
{
    use Tools;

    private $dateNow, $repos, $userSession;
    public function __construct()
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        $this->dateNow = now(env('APP_TIMEZONE', 'Asia/Jakarta'));

        $this->repos = new ClientRepository();

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
        $day = 30;
        $days = (isset($req->actived_lifetime) && !empty($req->actived_lifetime) ? $req->actived_lifetime * $day : $day);
        $expreDate = (clone $this->dateNow)->addDays($days)->toDateTimeString();
        $expreDate = (isset($req->expired_date) && !empty($req->expired_date) ? $req->expired_date : $expreDate);

        $data = [
            'name' => $req->klinik_name,
            'company_profile' => $req->klinik_biography,
            'id_provinsi' => $req->id_provinsi,
            'id_kabupaten' => $req->id_kabupaten,
            'id_kecamatan' => $req->id_kecamatan,
            'id_kelurahan' => $req->id_kelurahan,
            'address' => $req->address,
            // 'id_tier_level' => $req->id_tier_level,
            'expired_date' => $this->ReformatDateTime($expreDate, true),
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
            'name' => $req->klinik_name,
            'company_profile' => $req->klinik_biography,
            'id_provinsi' => $req->id_provinsi,
            'id_kabupaten' => $req->id_kabupaten,
            'id_kecamatan' => $req->id_kecamatan,
            'id_kelurahan' => $req->id_kelurahan,
            'address' => $req->address,
            'id_tier_level' => $req->id_tier_level,
            'updated_at' => $this->ReformatDateTime($this->dateNow, true)
        ];

        return $this->repos->update($data, $id);
    }

    public function destroy(string $id)
    {
        return $this->repos->destroy($id);
    }
}
