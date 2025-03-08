<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Libraries\Tools;
use App\Http\Libraries\ResponseCode;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\GolonganDarah;

class WebController extends Controller
{

    private $resCode, $tools, $userAgent;
    public function __construct()
    {
        $this->tools = new Tools;
        $this->resCode = new ResponseCode;
        $this->userAgent = request()->header('User-Agent');
    }

    public function GolonganDarah(Request $req)
    {
        $goldar = GolonganDarah::select('id', 'name')->get();
        return view('master-data.golongan-darah', compact('goldar'));
    }

    public function Wilayah(Request $req)
    {
        return view('master-data.wilayah');
    }


    public function UserSystem(Request $request)
    {
        if ($request->ajax()) {
            $users = User::select(
                        'users.username',
                        'users.email',
                        'users.status',
                        'roles.name as role_name',
                        'roles.description'
                    )
                    ->join('roles', 'users.id_role', '=', 'roles.id')
                    ->get();

            return $this->resCode->OKE("berhasil mengambil data", $users);
        }

        return view('master-data.user-system');
    }

    public function PendaftaranPasien(Request $req)
    {
        return view('transaksi.pendaftaran-pasien');
    }
}
