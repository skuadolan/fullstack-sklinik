<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

use Illuminate\Support\Facades\DB;

class AutocompleteLayout extends Component
{
    public $section, $get;
    public $listProvinsi;
    public function __construct($section = null, $get = null)
    {
        $this->section = $section;
        $this->get = $get;

        if ($section = "ssr-dropdown" && $get == 'provinsi') {
            $qry = "SELECT prov.id, prov.name FROM provinsi prov ORDER BY prov.name ASC";
            $this->listProvinsi = DB::select("$qry");
        }
    }

    public function render(): View
    {
        return view('components.partials.TextAutocomplete');
    }
}
