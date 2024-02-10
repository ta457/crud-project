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

    public function scopePermsOf($query, $roleName)
    {
        return $query->where('name', 'like', '%' . $roleName . '%');
    }

    public function getSortedPermsAttribute()
    {
        return [
            'role' => $this->permsOf('role')->get(),
            'permission' => $this->permsOf('permission')->get(),
            'user' => $this->permsOf('user')->get(),
            'category' => $this->permsOf('cate')->get(),
            'product' => $this->permsOf('product')->get(),
        ];
    }
}
