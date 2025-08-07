<?php

namespace App\Http\Repositories\V1\Pendaftaran\Client;

use Exception;

use App\Traits\Tools;

use App\Http\Repositories\Interfaces;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\Pendaftaran\Client\ListClient;

use App\Http\Services\V1\Pendaftaran\PendudukService;
use App\Http\Services\V1\Pendaftaran\Client\UserService;
use App\Http\Services\V1\Pendaftaran\Client\PegawaiService;

class ClientRepository implements Interfaces
{
    use Tools;

    private $clientModel;
    private $pddService, $usrService, $pgwService;
    public function __construct()
    {
        $this->clientModel = new ListClient();

        $this->usrService = new UserService();
        $this->pddService = new PendudukService();
        $this->pgwService = new PegawaiService();
    }

    public function store(object $req)
    {
        try {
            Log::info("START SIMPAN NEW CLIENT: ", [
                "request" => $this->arryToJSON($req->all())
            ]);

            DB::beginTransaction();

            $clientData = $this->clientModel->SchemaDataModel($req);
            $this->unsetNewDataRecord($clientData);
            $req->id_client = DB::table('list_client')->insertGetId($clientData);

            $req->id_penduduk = $this->pddService->Create($req);
            $req->id_user = $this->usrService->Create($req);

            $req->id_pegawai = $this->pgwService->Create($req);
            $pegawai = $this->pgwService->GetById($req->id_pegawai);

            if (!$this->valNotEmpty($pegawai)) { throw new Exception("Error Processing Request! Kesalahan data", 500); }

            DB::commit();

            return $pegawai;
        } catch (Exception $err) {
            DB::rollBack();

            Log::error("GAGAL SIMPAN NEW CLIENT: ", [
                "error" => $err->getMessage(),
                "request" => $this->arryToJSON($req->all())
            ]);

            throw $err->getMessage();
        }
    }

    public function index(object $req) {}

    public function show(string $id) {}

    public function update(object $req, string $id) {}

    public function destroy(string $id) {}
}
