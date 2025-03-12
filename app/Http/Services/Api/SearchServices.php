<?php

namespace App\Http\Services\Api;

use Illuminate\Http\Request;
use App\Http\Services\Services;

use App\Http\Controllers\Api\SearchController;

class SearchServices extends Services
{
    public function __construct()
    {
        parent::__construct(new SearchController);
    }

    public function index(Request $req)
    {
        return $this->GetAllDatas($req);
    }
}
