<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penduduk extends Model
{
    protected $table = 'penduduk';
    use Notifiable, SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'fullname',
        'handphone',
        'whatsapp',
        'telegram',
        'birthdate',
        'goldar',
        'gender',
        'tempat_lahir',
        'agama',
        'address',
        'id_provinsi',
        'id_kabupaten',
        'id_kecamatan',
        'id_kelurahan',
        'id_user_created',
        'id_user_updated',
        'expired_date',
        'is_actived',
        'is_deleted',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function SchemaDataModel(object $req) {
        $nik = (isset($req->nik_user) && !empty($req->nik_user) ? $req->nik_user : $req->nik_pasien);
        $fullname = (isset($req->fullname_user) && !empty($req->fullname_user) ? $req->fullname_user : $req->nama_pasien);
        $handphone = (isset($req->handphone_user) && !empty($req->handphone_user) ? $req->handphone_user : $req->handphone_pasien);
        $whatsapp = (isset($req->whatsapp_user) && !empty($req->whatsapp_user) ? $req->whatsapp_user : $req->whatsapp_pasien);
        $telegram = (isset($req->telegram_user) && !empty($req->telegram_user) ? $req->telegram_user : $req->telegram_pasien);
        $address = (isset($req->address_user) && !empty($req->address_user) ? $req->address_user : $req->address_pasien);
        $gender = (isset($req->gender_user) && !empty($req->gender_user) ? $req->gender_user : $req->gender);
        $goldar = (isset($req->goldar_user) && !empty($req->goldar_user) ? $req->goldar_user : $req->goldar);
        $id_user = (isset($req->id_user) && !empty($req->id_user) ? $req->id_user : null);

        return [
            'nik' => $nik,
            'fullname' => $fullname,
            'handphone' => $handphone,
            'whatsapp' => $whatsapp,
            'telegram' => $telegram,
            'agama' => $req->agama_user,
            'tempat_lahir' => $req->tempat_lahir_user,
            'birthdate' => $req->birthdate_user,
            'address' => $address,
            'gender' => $gender,
            'goldar' => $goldar,
            'id_provinsi' => $req->id_provinsi,
            'id_kabupaten' => $req->id_kabupaten,
            'id_kecamatan' => $req->id_kecamatan,
            'id_kelurahan' => $req->id_kelurahan,

            'id_user_created' => $id_user,
            'id_user_updated' => $id_user,
            'created_at' => $req->dateNow,
            'updated_at' => $req->dateNow,
        ];
    }
}
