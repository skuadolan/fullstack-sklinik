<?php

namespace App\Http\Repositories;

interface Interfaces
{
    function store(object $req);
    function index(object $req);
    function show(string $id);
    function update(object $req, string $id);
    function destroy(string $id);
}
