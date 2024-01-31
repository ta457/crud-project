<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        $currentUser = auth()->user();

        return view('users.index', compact('users', 'currentUser'));
    }

    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('web.users.index');
    }

    public function show(User $user)
    {
        if ($user->id === 1) {
            return redirect()->route('web.users.index');
        }

        $currentUser = auth()->user();

        // get all roles and remove the first role (admin) from the list
        $roles = Role::all()->except(1);

        return view('users.show', compact('user', 'roles', 'currentUser'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        if ($user->id !== 1) {
            $user->update($request->validated());
        }

        if ($request->has('selected')) {
            $selectedRoleIds = $request->input('selected', []);
            $selectedRoles = Role::whereIn('id', $selectedRoleIds)->get();
            $user->roles()->sync($selectedRoles);
        }

        return redirect()->route('web.users.show', $user->id);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('web.users.index');
    }
}