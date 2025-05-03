<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    use Notifiable, SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_pasien',
        'id_client',
        'is_lunas',
        'jenis_pasien',
        'status_pendaftaran',
        'id_user_created',
        'id_user_updated',
        'is_actived',
        'is_deleted',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function SchemaDataModel(object $req) {
        return [
            'id_pasien' => $req->id_pasien,
            'id_client' => $req->id_client,
            'is_lunas' => 'Belum',
            'jenis_pasien' => 'Baru',
            'status_pendaftaran' => 'Menunggu',
            'id_user_created' => $req->id_user,
            'id_user_updated' => $req->id_user,
            'created_at' => $req->dateNow,
            'updated_at' => $req->dateNow,
        ];
    }
}
