<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    use Notifiable, SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'id_profesi',
        'id_penduduk',
        'id_client',
        'id_user_created',
        'id_user_updated',
        'is_actived',
        'is_deleted',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function SchemaDataModel(object $req) {
        $id_profesi = (isset($req->id_profesi) && !empty($req->id_profesi) ? $req->id_profesi : null);

        return [
            'id_user' => $req->id_user,
            'id_profesi' => $id_profesi,
            'id_penduduk' => $req->id_penduduk,
            'id_client' => $req->id_client,

            'created_at' => $req->dateNow,
            'updated_at' => $req->dateNow,

            'id_user_created' => $req->id_user,
            'id_user_updated' => $req->id_user,
        ];
    }
}
