<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'id_role',
        'id_client',
        'id_penduduk',
        'email_verified_at',
        'ip_address',
        'last_login',
        'id_user_created',
        'id_user_updated',
        'is_actived',
        'is_deleted',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function SchemaDataModel(object $req) {
        $id_user = (isset($req->id_user) && !empty($req->id_user) ? $req->id_user : null);
        $id_client = (isset($req->id_client) && !empty($req->id_client) ? $req->id_client : null);
        $id_penduduk = (isset($req->id_penduduk) && !empty($req->id_penduduk) ? $req->id_penduduk : null);

        return [
            'username' => $req->username,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'id_client' => $id_client,
            'id_penduduk' => $id_penduduk,
            'id_user_created' => $id_user,
            'id_user_updated' => $id_user,
            'created_at' => $req->dateNow,
            'updated_at' => $req->dateNow,
        ];
    }
}
