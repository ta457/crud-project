<?php


namespace App\Repositories;

use App\Models\Permission;
use App\Repositories\BaseRepository;

class PermissionRepository extends BaseRepository
{
    public function model()
    {
        return Permission::class;
    }

    public function getSortedPerms()
    {
        return $this->model->sorted_perms;
    }
}