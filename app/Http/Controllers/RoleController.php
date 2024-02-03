<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = Role::paginate(10);

        $user = auth()->user();

        $permsForRole = Permission::permsForRole()->get();
        $permsForPermission = Permission::permsForPermission()->get();
        $permsForUser = Permission::permsForUser()->get();
        $permsForCategory = Permission::permsForCategory()->get();
        $permsForProduct = Permission::permsForProduct()->get();

        return view(
            'roles.index', 
            compact('roles', 'user', 'permsForRole', 'permsForPermission', 'permsForUser', 'permsForCategory', 'permsForProduct')
        );
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->validated());

        if ($request->has('selected')) {
            $selectedPermIds = $request->input('selected', []);
            $selectedPermissions = Permission::whereIn('id', $selectedPermIds)->get();
            $role->permissions()->sync($selectedPermissions);
        }

        return redirect()->route('web.roles.index');
    }

    public function show(Role $role)
    {
        if ($role->id === 1) {
            return redirect()->route('web.roles.index');
        }

        $user = auth()->user();

        $permsForRole = Permission::permsForRole()->get();
        $permsForPermission = Permission::permsForPermission()->get();
        $permsForUser = Permission::permsForUser()->get();
        $permsForCategory = Permission::permsForCategory()->get();
        $permsForProduct = Permission::permsForProduct()->get();

        $role->hasAllPermissions($permsForProduct);

        return view(
            'roles.show', 
            compact('role', 'user', 'permsForRole', 'permsForPermission', 'permsForUser', 'permsForCategory', 'permsForProduct')
        );
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->roleService->updateRole($request, $role);

        return redirect()->route('web.roles.show', $role->id);
    }

    public function destroy(Role $role)
    {
        if ($role->id !== 1) {
            $role->delete();
        }

        return redirect()->route('web.roles.index');
    }
}
