<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(10);

        $user = auth()->user();

        return view('permissions.index', compact('permissions', 'user'));
    }

    public function store(StorePermissionRequest $request)
    {
        Permission::create($request->validated());

        return redirect()->route('web.permissions.index');
    }

    public function show(Permission $permission)
    {
        $user = auth()->user();

        return view('permissions.show', compact('permission', 'user'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->validated());

        return redirect()->route('web.permissions.show', $permission->id);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('web.permissions.index');
    }
}
