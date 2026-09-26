<?php

namespace App\Models\Master;

use App\Enums\Master\RegionEnum;
use Illuminate\Database\Eloquent\Model;

class RegionModel extends Model
{
    protected $table = 'regions';

    protected $fillable = [
        'parent_id',
        'code',
        'name',
        'level',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'level' => RegionEnum::class,
        ];
    }
}
