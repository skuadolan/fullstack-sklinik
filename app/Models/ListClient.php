<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListClient extends Model
{
    protected $table = 'list_clients';
    use Notifiable, SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'company_profile',
        'id_provinsi',
        'id_kabupaten',
        'id_kecamatan',
        'id_kelurahan',
        'address',
        'id_tier_level',
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
        $id_user = (isset($req->id_user) && !empty($req->id_user) ? $req->id_user : null);
        $id_tier_level = (isset($req->id_tier_level) && !empty($req->id_tier_level) ? $req->id_tier_level : 1);

        return [
            'name' => $req->klinik_name,
            'company_profile' => $req->klinik_biography,
            'id_provinsi' => $req->id_provinsi,
            'id_kabupaten' => $req->id_kabupaten,
            'id_kecamatan' => $req->id_kecamatan,
            'id_kelurahan' => $req->id_kelurahan,
            'address' => $req->address,
            'id_tier_level' => $id_tier_level,

            'expired_date' => $req->expreDate,
            'id_user_created' => $id_user,
            'id_user_updated' => $id_user,
            'created_at' => $req->dateNow,
            'updated_at' => $req->dateNow,
        ];
    }
}
