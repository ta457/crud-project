<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(10);

        $user = auth()->user();

        return view('permissions.index', compact('permissions', 'user'));
    }

    public function show(Permission $permission)
    {
        $user = auth()->user();

        return view('permissions.show', compact('permission', 'user'));
    }
}
