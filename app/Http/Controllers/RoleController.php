<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index()
    {
        if (! Gate::allows('view-roles')) {
            abort(403);
        }

        $roles = Role::paginate(10);

        $user = auth()->user();

        return view('roles.index', compact('roles', 'user'));
    }

    public function store(StoreRoleRequest $request)
    {
        if (! Gate::allows('create-role')) {
            abort(403);
        }

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
        if (! Gate::allows('update-role')) {
            abort(403);
        }

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
        if (! Gate::allows('delete-role')) {
            abort(403);
        }

        if ($role->id !== 1) {
            $role->delete();
        }

        return redirect()->route('web.roles.index');
    }
}
