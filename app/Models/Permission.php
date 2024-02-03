<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_permissions');
    }

    public function scopePermsForRole($query)
    {
        return $query->where('name', 'like', '%role%');
    }

    public function scopePermsForPermission($query)
    {
        return $query->where('name', 'like', '%permission%');
    }

    public function scopePermsForUser($query)
    {
        return $query->where('name', 'like', '%user%');
    }

    public function scopePermsForCategory($query)
    {
        return $query->where('name', 'like', '%categor%');
    }

    public function scopePermsForProduct($query)
    {
        return $query->where('name', 'like', '%product%');
    }
}
