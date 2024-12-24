<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AutocompleteLayout extends Component
{
    public $section, $get;
    public function __construct($section, $get)
    {
        $this->section = $section;
        $this->get = $get;
    }

    public function render(): View
    {
        return view('components.partials.TextAutocomplete');
    }
}
