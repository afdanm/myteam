<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PermissionGroup;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(self::class, 'menu_id');
    }

    public function child()
    {
        return $this->hasMany(self::class, 'menu_id');
    }

    public function permissiongroup()
    {
        return $this->belongsTo(PermissionGroup::class, 'permission_group_id');
    }
}
