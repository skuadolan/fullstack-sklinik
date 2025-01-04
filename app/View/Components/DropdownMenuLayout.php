<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;
use Illuminate\View\View;

class DropdownMenuLayout extends Component
{
    public $listMenu;
    public function __construct()
    {
        $qry = "SELECT * FROM LIST_MENUS lsmenu";
        $this->listMenu = DB::select("$qry");
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('components.partials.CustomizeDropdownMenuLayout');
    }
}
