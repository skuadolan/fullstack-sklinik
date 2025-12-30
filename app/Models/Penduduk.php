<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penduduk extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'penduduk';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'fullname',
        'nik',
        'nomor_identitas_lain',
        'nama_ibu',
        'nik_ibu',
        'tempat_lahir',
        'birthdate',
        'agama',
        'suku_ras',
        'goldar',
        'alamat_domisili',
        'alamat_ktp',
        'dinamis_penduduk',
        'pendidikan',
        'pekerjaan',
        'status_pernikahan',
        'gender',
        'perkiraan_umur',
        'lokasi_ditemukan',
        'tanggal_ditemukan',
        'id_provinsi',
        'id_kabupaten',
        'id_kecamatan',
        'id_kelurahan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'nik',
        'nomor_identitas_lain',
        'nik_ibu'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_ditemukan' => 'datetime',
            'birthdate' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }
}
