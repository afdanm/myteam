<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PermissionGroup;

class Permission extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function permissiongroup()
    {
        return $this->belongsTo(PermissionGroup::class, 'permission_group_id');
    }
}
