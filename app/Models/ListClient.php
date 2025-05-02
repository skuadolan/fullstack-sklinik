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
}
