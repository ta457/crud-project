<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);

        return view('roles.index', compact('roles'));
    }

    public function store(StoreRoleRequest $request)
    {
        Role::create($request->validated());

        return redirect()->route('web.roles.index');
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        return redirect()->route('web.roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('web.roles.index');
    }
}
