<?php

namespace App\Services;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Repositories\RoleRepository;
use RealRashid\SweetAlert\Facades\Alert;

class RoleService
{
    protected $roleRepo;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepo = $roleRepo;
    }

    public function getAllExceptAdmin()
    {
        return $this->roleRepo->getAllExceptAdmin();
    }

    public function getLatestRoles()
    {
        return $this->roleRepo->getLatestRoles();
    }

    public function assignPermsFromRequest($role, $request)
    {
        if ($request->has('selected')) {
            $selectedPermIds = $request->input('selected', []);
            $selectedPermissions = Permission::whereIn('id', $selectedPermIds)->get();
            $this->roleRepo->assignPerms($role, $selectedPermissions);
        }
    }

    public function storeRole(StoreRoleRequest $request)
    {
        $role = $this->roleRepo->create($request->validated());

        $this->assignPermsFromRequest($role, $request);

        Alert::success('Success', 'Role created successfully!');
    }

    public function updateRole(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        $this->assignPermsFromRequest($role, $request);
        
        Alert::success('Success', 'Role updated successfully!');
    }

    public function deleteRole(Role $role)
    {
        if ($role->id !== 1) {
            $this->roleRepo->delete($role->id);
            Alert::success('Success', 'Role deleted successfully!');
        } else {
            Alert::error('Error', 'You are not allowed to delete this role!');
        }
    }
}