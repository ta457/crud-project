<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use App\Services\RoleService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    protected $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function index()
    {
        $users = $this->userService->getLatestUsers();

        $currentUser = auth()->user();
        $roles = $this->roleService->getAllExceptAdmin();

        return view('users.index', compact('users', 'currentUser', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->storeUser($request);

        return redirect()->route('web.users.index');
    }

    public function show(User $user)
    {
        if ($user->hasRole('super-admin')) {
            return redirect()->route('web.users.index');
        }

        $roles = $this->roleService->getAllExceptAdmin();
        $currentUser = auth()->user();

        return view('users.show', compact('user', 'roles', 'currentUser'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->updateUser($request, $user);

        return redirect()->route('web.users.show', $user->id);
    }

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);

        return redirect()->route('web.users.index');
    }

    public function search(Request $request)
    {
        $users = $this->userService->search($request->input('search'));

        $currentUser = auth()->user();
        $roles = $this->roleService->getAllExceptAdmin();

        return view('users.index', compact('users', 'currentUser', 'roles'));
    }
}