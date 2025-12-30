<?php

namespace App\Services;

use App\DTO\RegisterCustomerDto;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Penduduk\PendudukRepositoryInterface;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterCustomerService
{
    public function __construct(
        protected UserRepositoryInterface $usrRepos,
        protected PendudukRepositoryInterface $pddkRepos
    ) {}

    public function register(RegisterCustomerDto $dto)
    {
        try {
            DB::beginTransaction();

            Log::info("START SIMPAN USER: ", [
                "request" => arrayToString($dto)
            ]);

            $penduduk = $this->pddkRepos->create([
                'first_name' => $dto->first_name,
                'last_name' => $dto->last_name,
                'fullname' => $dto->fullname,
                'nik' => $dto->nik,
                'nomor_identitas_lain' => $dto->nomor_identitas_lain,
                'nama_ibu' => $dto->nama_ibu,
                'nik_ibu' => $dto->nik_ibu,
                'tempat_lahir' => $dto->tempat_lahir,
                'birthdate' => $dto->birthdate,
                'agama' => $dto->agama,
                'suku_ras' => $dto->suku_ras,
                'goldar' => $dto->goldar,
                'alamat_domisili' => $dto->alamat_domisili,
                'alamat_ktp' => $dto->alamat_ktp,
                'dinamis_penduduk' => $dto->dinamis_penduduk,
                'pendidikan' => $dto->pendidikan,
                'pekerjaan' => $dto->pekerjaan,
                'status_pernikahan' => $dto->status_pernikahan,
                'gender' => $dto->gender,
                'perkiraan_umur' => $dto->perkiraan_umur,
                'lokasi_ditemukan' => $dto->lokasi_ditemukan,
                'tanggal_ditemukan' => $dto->tanggal_ditemukan,
                'id_provinsi' => $dto->id_provinsi,
                'id_kabupaten' => $dto->id_kabupaten,
                'id_kecamatan' => $dto->id_kecamatan,
                'id_kelurahan' => $dto->id_kelurahan,
            ]);

            // create user
            $user = $this->usrRepos->create([
                'username' => $dto->username,
                'email' => $dto->email,
                'id_role' => 8,
                'id_penduduk' => $penduduk->id,
                'password' => $dto->password,
                'is_actived' => null,
                'expired_date' => null,
            ]);

            DB::commit();
            return $user;
        } catch (Exception $err) {
            DB::rollBack();

            Log::error("GAGAL SIMPAN USER: ", [
                "error" => $err->getMessage(),
                "request" => arrayToString($dto)
            ]);

            throw $err;
        }
    }
}
