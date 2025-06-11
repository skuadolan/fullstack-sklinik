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
    public $listStatusPendaftaran, $jenisKunjungan, $listPerkiraanUmur;
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
            $this->listGender = ['Tidak Diketahui', 'Laki-Laki', 'Perempuan', 'Tidak Dapat Ditentukan', 'Tidak Mengisi'];
        }

        if ($section = "ssr-dropdown" && $get == 'unit') {
            $qry = "SELECT unt.id, unt.name FROM unit unt ORDER BY unt.name ASC";
            $this->listUnit = DB::select("$qry");
        }

        if ($section = "ssr-dropdown" && $get == 'status_pendaftaran') {
            $this->listStatusPendaftaran = ['Batal', 'Masuk', 'Menunggu', 'Diperiksa', 'Resep', 'Mutasi Rajal', 'Ranap', 'Mutasi Ranap', 'Keluar', 'Selesai', 'Booking'];
        }

        if ($section = "ssr-dropdown" && $get == 'jenis_kunjungan') {
            $this->jenisKunjungan = ['Rawat Darurat', 'Rawat Jalan', 'Rawat Inap'];
        }

        if ($section = "ssr-dropdown" && $get == 'perkiraan_umur') {
            $this->listPerkiraanUmur = ['Tidak Tau', '0 - 5', '6 - 11', '12 - 17', '18 - 40', '41 - 65', '> 65'];
        }
    }

    public function render(): View
    {
        return view('components.partials.TextAutocomplete');
    }
}
