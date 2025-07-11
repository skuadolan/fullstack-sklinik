<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PendaftaranPasienRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'norm_pasien' => ['nullable', 'string', 'max:255', 'regex:/^[0-9]+$/'],
            'nik_pasien' => ['nullable', 'string', 'max:255', 'regex:/^[0-9]+$/'],
            'fullname_pasien' => ['required', 'string', 'max:255'],
            'tempat_lahir_pasien' => ['required', 'string', 'max:255'],
            'tanggal_lahir_pasien' => ['required', 'date', 'date_format:d-m-Y'],
            'agama_pasien' => ['nullable', 'string', 'max:255'],
            'suku_ras_pasien' => ['nullable', 'string', 'max:255'],
            'goldar_pasien' => ['required', 'string', 'max:255'],
            'pendidikan_pasien' => ['required', 'string', Rule::in(['Tidak Diketahui', 'Tidak Sekolah', 'SD', 'SLTP', 'SLTA', 'D1-D3', 'D4', 'S1', 'S2', 'S3'])],
            'pekerjaan_pasien' => ['required', 'string', Rule::in(['Tidak Diketahui', 'Tidak Bekerja', 'PNS', 'TNI/POLRI', 'BUMN', 'Pegawai', 'Swasta/Wirausaha', 'Buruh', 'Lain-lain'])],
            'status_pernikahan_pasien' => ['required', 'string', Rule::in(['Tidak Diketahui', 'Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'])],
            'gender_pasien' => ['required', 'string', Rule::in(['Tidak Diketahui', 'Laki-Laki', 'Perempuan', 'Tidak Dapat Ditentukan', 'Tidak Mengisi'])],

            'alamat_domisili_pasien' => ['required', 'string', 'max:255'],
            'id_provinsi_domisili_pasien' => ['required', 'integer', 'exists:provinsi,id'],
            'id_kabupaten_domisili_pasien' => ['required', 'integer', 'exists:kabupaten,id'],
            'id_kecamatan_domisili_pasien' => ['required', 'integer', 'exists:kecamatan,id'],
            'id_kelurahan_domisili_pasien' => ['required', 'integer', 'exists:kelurahan,id'],

            'alamat_ktp_pasien' => ['required', 'string', 'max:255'],
            'id_provinsi_ktp_pasien' => ['required', 'integer', 'exists:provinsi,id'],
            'id_kabupaten_ktp_pasien' => ['required', 'integer', 'exists:kabupaten,id'],
            'id_kecamatan_ktp_pasien' => ['required', 'integer', 'exists:kecamatan,id'],
            'id_kelurahan_ktp_pasien' => ['required', 'integer', 'exists:kelurahan,id'],

            'nama_ibu_pasien' => ['required', 'string', 'max:255'],
            'nik_ibu_pasien' => ['nullable', 'string', 'max:255', 'regex:/^[0-9]+$/'],
        ];
    }


    public function messages(): array
    {
        return [
            'id_provinsi_domisili_pasien.exists' => 'Provinsi tidak ditemukan.',
            'id_kabupaten_domisili_pasien.exists' => 'Kabupaten tidak ditemukan.',
            'id_kecamatan_domisili_pasien.exists' => 'Kecamatan tidak ditemukan.',
            'id_kelurahan_domisili_pasien.exists' => 'Kelurahan tidak ditemukan.',

            'id_provinsi_ktp_pasien.exists' => 'Provinsi tidak ditemukan.',
            'id_kabupaten_ktp_pasien.exists' => 'Kabupaten tidak ditemukan.',
            'id_kecamatan_ktp_pasien.exists' => 'Kecamatan tidak ditemukan.',
            'id_kelurahan_ktp_pasien.exists' => 'Kelurahan tidak ditemukan.',

            'gender.exists' => 'Gender tidak ditemukan.',
            'nik_user.unique' => 'NIK sudah terdaftar.',
            'nik.regex' => 'NIK hanya boleh berisi angka.',
        ];
    }

    public function attributes(): array
    {
        return [
            'id_provinsi_domisili_pasien' => 'provinsi',
            'id_kabupaten_domisili_pasien' => 'kabupaten',
            'id_kecamatan_domisili_pasien' => 'kecamatan',
            'id_kelurahan_domisili_pasien' => 'kelurahan',

            'id_provinsi_ktp_pasien' => 'provinsi',
            'id_kabupaten_ktp_pasien' => 'kabupaten',
            'id_kecamatan_ktp_pasien' => 'kecamatan',
            'id_kelurahan_ktp_pasien' => 'kelurahan',
        ];
    }
}
