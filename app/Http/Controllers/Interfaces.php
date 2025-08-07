<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

interface Interfaces
{
    function __construct();
    function Create(object $req): JsonResponse;
    function GetByParams(object $req): JsonResponse;
    function GetById(string $id): JsonResponse;
    function UpdateById(object $req, string $id): JsonResponse;
    function DeleteById(string $id): JsonResponse;
}
