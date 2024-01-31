<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);

        $user = auth()->user();

        return view('roles.index', compact('roles', 'user'));
    }

    public function store(StoreRoleRequest $request)
    {
        Role::create($request->validated());

        return redirect()->route('web.roles.index');
    }

    public function show(Role $role)
    {
        if ($role->id === 1) {
            return redirect()->route('web.roles.index');
        }

        $user = auth()->user();

        $permissions = Permission::all();

        return view('roles.show', compact('role', 'user', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
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
