<?php

namespace App\Services\Api\V1;

class SearchService
{
    public function __construct(private $repos = new SearchRepository()) {}

    public function getWilayah($req)
    {
        // return $this->repos->getWilayah($req);
    }
    public function getRoles($req)
    {
        // return $this->repos->getRoles($req);
    }
    public function getUsers($req)
    {
        // return $this->repos->getUsers($req);
    }
    public function getPasien($req)
    {
        // return $this->repos->getPasien($req);
    }
    public function getRajal($req)
    {
        // return $this->repos->getRajal($req);
    }
    public function getRanap($req)
    {
        // return $this->repos->getRanap($req);
    }
    public function getKunjunganPasienByID($req)
    {
        // return $this->repos->getKunjunganPasienByID($req);
    }
}
