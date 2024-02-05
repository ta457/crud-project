<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function getRoleNameListAttribute()
    {
        // return a string of role names
        return $this->roles->pluck('name')->implode(', ');
    }

    public function hasRole($roleName)
    {
        $role = Role::where('name', $roleName)->first();

        return $this->roles->contains($role);
    }

    public function hasPermission($permissionName)
    {
        if ($this->hasRole('super-admin')) {
            return true;
        }

        $roles = $this->roles;

        $permission = Permission::where('name', $permissionName)->first();

        foreach ($roles as $role) {
            if ($role->permissions->contains($permission)) {
                return true;
            }
        }

        return false;
    }
    
    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', "%$keyword%")
            ->orWhere('email', 'like', "%$keyword%")
            ->orWhereHas('roles', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            });
    }
}
