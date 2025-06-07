<?php

namespace App\Models;

use App\Traits\Tools;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penduduk extends Model
{
    protected $table = 'penduduk';
    use Notifiable, SoftDeletes, HasFactory, Tools;

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
        'is_actived',
        'is_deleted',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function SchemaDataModel(object $req)
    {
        setlocale(LC_TIME, 'id_ID.utf8');
        $dateNow = now(env('APP_TIMEZONE', 'Asia/Jakarta'));
        $userSession = session('user_login');

        $date = $this->ReformatDateTime($dateNow, true);
        $id_user = $this->GetUserIDFromRequest($req, $userSession);
        $nik = ($this->isValidVal($req->nik_user) ? $req->nik_user : $req->nik_pasien);
        $gender = ($this->isValidVal($req->gender_user) ? $req->gender_user : $req->gender);
        $goldar = ($this->isValidVal($req->goldar_user) ? $req->goldar_user : $req->goldar);
        $address = ($this->isValidVal($req->address_user) ? $req->address_user : $req->address_pasien);
        $fullname = ($this->isValidVal($req->fullname_user) ? $req->fullname_user : $req->nama_pasien);
        $whatsapp = ($this->isValidVal($req->whatsapp_user) ? $req->whatsapp_user : $req->whatsapp_pasien);
        $telegram = ($this->isValidVal($req->telegram_user) ? $req->telegram_user : $req->telegram_pasien);
        $handphone = ($this->isValidVal($req->handphone_user) ? $req->handphone_user : $req->handphone_pasien);
        $tanggal_lahir = ($this->isValidVal($req->tanggal_lahir_pasien) ? $req->tanggal_lahir_pasien : $req->tanggal_lahir);

        return [
            'nik' => $nik,
            'fullname' => $fullname,
            'handphone' => $handphone,
            'whatsapp' => $whatsapp,
            'telegram' => $telegram,
            'birthdate' => $tanggal_lahir,
            'goldar' => $goldar,
            'gender' => $gender,
            'tempat_lahir' => $req->tempat_lahir,
            'agama' => $req->agama,
            'address' => $address,
            'id_provinsi' => $req->id_provinsi,
            'id_kabupaten' => $req->id_kabupaten,
            'id_kecamatan' => $req->id_kecamatan,
            'id_kelurahan' => $req->id_kelurahan,
            'id_user_created' => $id_user,
            'id_user_updated' => $id_user,
            'is_actived' => $req->is_actived,
            'is_deleted' => $req->is_deleted,
            'created_at' => $date,
            'updated_at' => $date,
            'deleted_at' => $date,
        ];
    }
}
