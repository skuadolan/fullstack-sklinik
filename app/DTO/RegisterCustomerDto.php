<?php

namespace App\DTO;

use Illuminate\Support\Facades\Hash;

class RegisterCustomerDto
{
    public function __construct(
        public string $username,
        public string $email,
        public string $password,

        public string $first_name,
        public string $last_name,
        public string $fullname,
        public string $nik,
        public string $nomor_identitas_lain,
        public string $nama_ibu,
        public string $nik_ibu,
        public string $tempat_lahir,
        public string $birthdate,
        public string $agama,
        public string $suku_ras,
        public string $goldar,
        public string $alamat_domisili,
        public string $alamat_ktp,
        public string $dinamis_penduduk,
        public string $pendidikan,
        public string $pekerjaan,
        public string $status_pernikahan,
        public string $gender,
        public string $perkiraan_umur,
        public string $lokasi_ditemukan,
        public string $tanggal_ditemukan,
        public int $id_provinsi,
        public int $id_kabupaten,
        public int $id_kecamatan,
        public int $id_kelurahan,
    ) {}

    public static function fromRequest($req): self
    {
        $jsonDatas = arrayToString($req);
        $jsonDatas = stringToArray($jsonDatas);
        
        $provinsi = getVarVal($jsonDatas, 'provinsi');
        $id_provinsi = getVarVal($provinsi, 'id');

        $kabupaten = getVarVal($jsonDatas, 'kabupaten');
        $id_kabupaten = getVarVal($kabupaten, 'id');

        $kecamatan = getVarVal($jsonDatas, 'kecamatan');
        $id_kecamatan = getVarVal($kecamatan, 'id');

        $kelurahan = getVarVal($jsonDatas, 'kelurahan');
        $id_kelurahan = getVarVal($kelurahan, 'id');

        return new self(
            username: getVarVal($jsonDatas, 'username'),
            email: getVarVal($jsonDatas, 'email'),
            password: Hash::make(getVarVal($jsonDatas, 'password')),

            nik: getVarVal($jsonDatas, 'nik'),
            first_name: getVarVal($jsonDatas, 'first_name'),
            last_name: getVarVal($jsonDatas, 'last_name'),
            fullname: getVarVal($jsonDatas, 'fullname'),
            nomor_identitas_lain: getVarVal($jsonDatas, 'nomor_identitas_lain'),
            nama_ibu: getVarVal($jsonDatas, 'nama_ibu'),
            nik_ibu: getVarVal($jsonDatas, 'nik_ibu'),
            tempat_lahir: getVarVal($jsonDatas, 'tempat_lahir'),
            birthdate: getVarVal($jsonDatas, 'birthdate'),
            agama: getVarVal($jsonDatas, 'agama'),
            suku_ras: getVarVal($jsonDatas, 'suku_ras'),
            goldar: getVarVal($jsonDatas, 'goldar'),
            alamat_domisili: getVarVal($jsonDatas, 'alamat_domisili'),
            alamat_ktp: getVarVal($jsonDatas, 'alamat_ktp'),
            dinamis_penduduk: getVarVal($jsonDatas, 'dinamis_penduduk'),
            pendidikan: getVarVal($jsonDatas, 'pendidikan'),
            pekerjaan: getVarVal($jsonDatas, 'pekerjaan'),
            status_pernikahan: getVarVal($jsonDatas, 'status_pernikahan'),
            gender: getVarVal($jsonDatas, 'gender'),
            perkiraan_umur: getVarVal($jsonDatas, 'perkiraan_umur'),
            lokasi_ditemukan: getVarVal($jsonDatas, 'lokasi_ditemukan'),
            tanggal_ditemukan: getVarVal($jsonDatas, 'tanggal_ditemukan'),
            id_provinsi: $id_provinsi,
            id_kabupaten: $id_kabupaten,
            id_kecamatan: $id_kecamatan,
            id_kelurahan: $id_kelurahan,
        );
    }
}
