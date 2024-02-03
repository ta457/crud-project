<?php

namespace App\Services;

use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;

class RoleService
{
    public function updateRole(UpdateRoleRequest $request, Role $role)
    {
        if ($role->id === 1) {
            return redirect()->route('web.roles.index');
        }

        $role->update($request->validated());

        if ($request->has('selected')) {
            $selectedPermIds = $request->input('selected', []);
            $selectedPermissions = Permission::whereIn('id', $selectedPermIds)->get();
            $role->permissions()->sync($selectedPermissions);
        }
    }
}