<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\Email;
use App\Models\User;
use App\Services\UserService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    protected $userService;
    protected $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function index($users = null)
    {
        if (!$users) {
            $users = $this->userService->getLatestUsers();
        }
        $roles = $this->roleService->getAllExceptAdmin();

        return view('users.index', compact('users', 'roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->storeUser($request);

        return redirect()->route('web.users.index');
    }

    public function show(User $user)
    {
        if ($user->hasRole('super-admin')) {
            Alert::error('Error', 'You are not allowed to view this user!');
            return redirect()->route('web.users.index');
        }

        $roles = $this->roleService->getAllExceptAdmin();
        $currentUser = auth()->user();

        return view('users.show', compact('user', 'roles', 'currentUser'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->updateUser($request, $user);

        return redirect()->route('web.users.index');
    }

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);

        return redirect()->route('web.users.index');
    }

    public function search(Request $request)
    {
        $users = $this->userService->search($request->input('search'), $request->input('role_id'));

        return $this->index($users);
    }

    public function reset(User $user)
    {
        $this->userService->resetPassword($user);
        return redirect()->route('web.users.index');
    }
}