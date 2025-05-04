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

        $this->userSession = session('user_login');
        // $sessionId = session()->getId();
        // $this->userSessionRedis = json_decode(Redis::get("session:$sessionId"), true);

        $this->repos = new ClientRepository();
    }

    public function index($req)
    {
        return $this->repos->index($req);
    }

    public function store(object $req)
    {
        $day = 30;
        $days = (isset($req->actived_lifetime) && !empty($req->actived_lifetime) ? $req->actived_lifetime * $day : $day);
        $req->expreDate = (clone $this->dateNow)->addDays($days)->toDateTimeString();

        $req->dateNow = $this->ReformatDateTime($this->dateNow, true);

        return $this->repos->store($req);
    }

    public function show(string $id)
    {
        return $this->repos->show($id);
    }

    public function update(object $req, string $id)
    {
        $req->dateNow = $this->ReformatDateTime($this->dateNow, true);
        $req->id_client = $this->GetClientIDFromRequest($req, $this->userSession);
        $req->id_user = $this->GetUserIDFromRequest($req, $this->userSession);

        return $this->repos->update($req, $id);
    }

    public function destroy(string $id)
    {
        return $this->repos->destroy($id);
    }
}
