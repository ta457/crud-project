<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Services\PermissionService;
class PermissionController extends Controller
{
    protected $permService;

    public function __construct(PermissionService $permService)
    {
        $this->permService = $permService;
    }

    public function index()
    {
        $permissions = $this->permService->getPermissions();

        $user = auth()->user();

        return view('permissions.index', compact('permissions', 'user'));
    }

    public function show(Permission $permission)
    {
        $user = auth()->user();

        return view('permissions.show', compact('permission', 'user'));
    }
}
