<?php

namespace App\View\Components;

use Illuminate\View\View;
use Illuminate\View\Component;

use Illuminate\Support\Facades\DB;

use App\Traits\Tools;

class AutocompleteLayout extends Component
{
    use Tools;

    public $section, $get;
    public $listProvinsi, $listGoldar, $listGender, $listUnit;
    public $listStatusPendaftaran, $jenisKunjungan;
    public function __construct($section = null, $get = null)
    {
        $this->section = $section;
        $this->get = $get;

        if ($section = "ssr-dropdown" && $get == 'provinsi') {
            $qry = "SELECT prov.id, prov.name FROM provinsi prov ORDER BY prov.name ASC";
            $this->listProvinsi = DB::select("$qry");
        }

        if ($section = "ssr-dropdown" && $get == 'goldar') {
            $qry = "SELECT goldar.id, goldar.name FROM goldar goldar ORDER BY goldar.name ASC";
            $this->listGoldar = DB::select("$qry");
        }

        if ($section = "ssr-dropdown" && $get == 'gender') {
            $qry = "SELECT gndr.id, gndr.name, gndr.value FROM gender gndr ORDER BY gndr.name ASC LIMIT 2";
            $this->listGender = DB::select("$qry");
        }

        if ($section = "ssr-dropdown" && $get == 'unit') {
            $qry = "SELECT unt.id, unt.name FROM unit unt ORDER BY unt.name ASC";
            $this->listUnit = DB::select("$qry");
        }

        $this->listStatusPendaftaran = ['Batal', 'Masuk', 'Menunggu', 'Diperiksa', 'Resep', 'Mutasi Rajal', 'Ranap', 'Mutasi Ranap', 'Keluar', 'Selesai', 'Booking'];
        $this->jenisKunjungan = ['Rawat Darurat', 'Rawat Jalan', 'Rawat Inap'];
    }

    public function render(): View
    {
        return view('components.partials.TextAutocomplete');
    }
}
