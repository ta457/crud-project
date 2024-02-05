<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService
{
    protected $permRepo;

    public function __construct(PermissionRepository $permRepo)
    {
        $this->permRepo = $permRepo;
    }

    public function getPermissions()
    {
        return $this->permRepo->paginate(10);
    }

    public function getSortedPerms()
    {
        return $this->permRepo->getSortedPerms();
    }
}