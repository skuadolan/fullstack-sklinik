<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Http\Controllers\Controller;

use Illuminate\View\View;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function GolonganDarah(Request $req): View
    {
        return view('master-data.golongan-darah');
    }
}
