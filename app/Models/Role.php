<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public function hasPermission($permissionName)
    {
        $permissions = $this->permissions;

        return $permissions->contains('name', $permissionName);
    }

    public function hasAllPermissions($permissions)
    {
        $permissions = $permissions instanceof Collection ? $permissions : collect($permissions);

        $permissionNames = $permissions->pluck('name')->toArray();

        foreach ($permissionNames as $permissionName) {
            if (!$this->hasPermission($permissionName)) {
                return false;
            }
        }

        return true;
    }
}
