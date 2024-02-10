<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Services\PermissionService;
use App\Services\RoleService;

class RoleController extends Controller
{
    protected $roleService;
    protected $permService;

    public function __construct(RoleService $roleService, PermissionService $permService)
    {
        $this->roleService = $roleService;
        $this->permService = $permService;
    }

    public function index()
    {
        $roles = $this->roleService->getLatestRoles();

        $sortedPerms = $this->permService->getSortedPerms();

        return view('roles.index', compact('roles', 'sortedPerms'));
    }

    public function store(StoreRoleRequest $request)
    {
        $this->roleService->storeRole($request);

        return redirect()->route('web.roles.index');
    }

    public function show(Role $role)
    {
        if ($role->id === 1) {
            return redirect()->route('web.roles.index');
        }

        $user = auth()->user();

        $sortedPerms = $this->permService->getSortedPerms();

        return view('roles.show',compact('role', 'user', 'sortedPerms'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        
        $this->roleService->updateRole($request, $role);
        
        return redirect()->route('web.roles.index');
    }

    public function destroy(Role $role)
    {
        $this->roleService->deleteRole($role);

        return redirect()->route('web.roles.index');
    }
}
