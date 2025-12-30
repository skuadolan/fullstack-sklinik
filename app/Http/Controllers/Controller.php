<?php

namespace App\Http\Controllers;

use App\Traits\HttpTraits;

abstract class Controller
{
    use HttpTraits;

    protected string $viewPath;

    public function __construct(string $viewPath = "") {
        $this->viewPath = $viewPath;
    }

    public function view(string $component, array $datas = []) {
        $tmpView = (isValNotEmpty($this->viewPath) ? "{$this->viewPath}/{$component}" : "{$component}");
        return $this->viewInertia($tmpView, $datas);
    }
}
