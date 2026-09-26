<?php

namespace App\Enums\Master;

enum RegionEnum: string
{
    case Province = 'province';
    case Regency = 'regency';
    case District = 'district';
    case Village = 'village';

    // Anda bisa menambahkan method helper di sini
    public function label(): string
    {
        return match ($this) {
            self::Province => 'Provinsi',
            self::Regency => 'Kabupaten/Kota',
            self::District => 'Kecamatan',
            self::Village => 'Kelurahan/Desa',
        };
    }
}
