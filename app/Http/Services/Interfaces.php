<?php

namespace App\Http\Services;

interface Interfaces
{
    function __construct();
    function Create(object $req);
    function GetByParams(object $req);
    function GetById(string $id);
    function UpdateById(object $req, string $id);
    function DeleteById(string $id);
}
