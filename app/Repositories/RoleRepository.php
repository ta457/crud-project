<?php


namespace App\Repositories;

use App\Models\Role;
use App\Repositories\BaseRepository;

class RoleRepository extends BaseRepository
{
    public function model()
    {
        return Role::class;
    }

    public function assignPerms($role, $permissions)
    {
        $role->permissions()->sync($permissions);
    }

    public function getLatestRoles()
    {
        return $this->model->latest()->paginate(10);
    }

    public function getAllExceptAdmin()
    {
        return $this->model->where('id', '!=', 1)->get();
    }
}