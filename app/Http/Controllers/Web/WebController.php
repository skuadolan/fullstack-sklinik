<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GolonganDarah;

class WebController extends Controller
{

    public function GolonganDarah(Request $req): View
    {
        // Mengambil data dari tabel golongan_darah
        $goldar = GolonganDarah::select('id', 'name')->get();

        // Mengirim data ke view
        return view('master-data.golongan-darah', compact('goldar'));
    }


    public function UserSystem()
    {
        // Ambil data dari tabel users
        $users = User::select('users.username', 'users.email', 'users.status', 'roles.name as role_name', 'roles.description')
                 ->join('roles', 'users.id_role', '=', 'roles.id')
                 ->get();
        // Kirim data ke view
        return view('master-data.user-system', compact('users'));
    }
}
