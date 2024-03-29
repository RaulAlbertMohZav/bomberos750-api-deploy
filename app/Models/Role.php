<?php

namespace App\Models;

use App\Core\Services\UUIDTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as RoleSpatieModel;

class Role extends RoleSpatieModel
{
    use UUIDTrait;
    public $keyType = "string";
    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        "id",
        'name',
        'alias_name',
        'guard_name',
    ];

    protected $casts = [
        'id' => 'string'
    ];

}
