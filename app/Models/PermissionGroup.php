<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class PermissionGroup extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(self::class, 'permission_group_id');
    }

    public function child()
    {
        return $this->hasMany(self::class, 'permission_group_id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'permission_group_id');
    }
}
