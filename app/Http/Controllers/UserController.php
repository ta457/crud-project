<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getLatestUsers();

        $currentUser = auth()->user();
        $roles = Role::all()->except(1);

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

        $roles = Role::all()->except(1);
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
        $roles = Role::all()->except(1);

        return view('users.index', compact('users', 'currentUser', 'roles'));
    }
}