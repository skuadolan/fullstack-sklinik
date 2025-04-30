<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'klinik_name' => ['required', 'string', 'max:255'],
            'klinik_biography' => ['nullable', 'longtext'],
            'id_provinsi' => ['required', 'integer', 'exists:provinsi,id'],
            'id_kabupaten' => ['required', 'integer', 'exists:kabupaten,id'],
            'id_kecamatan' => ['required', 'integer', 'exists:kecamatan,id'],
            'id_kelurahan' => ['required', 'integer', 'exists:kelurahan,id'],
            'address' => ['nullable', 'string', 'max:255'],
            'id_tier_level' => ['required', 'integer', 'exists:tier_level,id'],
        ];
    }


    public function messages(): array
    {
        return [
            'klinik_name' => "Nama Klinik Tidak Boleh Kosong!",
            'id_provinsi' => "Provinsi Tidak Boleh Kosong!",
            'id_kabupaten' => "Kabupaten Tidak Boleh Kosong!",
            'id_kecamatan' => "Kecamatan Tidak Boleh Kosong!",
            'id_kelurahan' => "Kelurahan Tidak Boleh Kosong!",
            'id_tier_level' => "Tier Level Tidak Boleh Kosong!",
        ];
    }

    public function attributes(): array
    {
        return [
            'id_provinsi' => 'provinsi',
            'id_kabupaten' => 'kabupaten',
            'id_kecamatan' => 'kecamatan',
            'id_kelurahan' => 'kelurahan',
        ];
    }
}
