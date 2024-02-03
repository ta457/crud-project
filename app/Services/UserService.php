<?php

namespace App\Services;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function assignRolesFromRequest($user, $request)
    {
        if ($request->has('selected')) {
            $selectedRoleIds = $request->input('selected', []);
            $selectedRoles = Role::whereIn('id', $selectedRoleIds)->get();
            $this->userRepository->assignRoles($user, $selectedRoles);
        }
    }

    public function getLatestUsers()
    {
        return $this->userRepository->getLatestUsers();
    }

    public function storeUser(StoreUserRequest $request)
    {
        $user = $this->userRepository->create($request->validated());

        $this->assignRolesFromRequest($user, $request);
    }

    public function updateUser(UpdateUserRequest $request, User $user)
    {
        if ($user->id !== 1) {
            $this->userRepository->update($request->validated(), $user->id);

            $this->assignRolesFromRequest($user, $request);
        }
    }

    public function deleteUser(User $user)
    {
        if ($user->id !== 1) {
            $this->userRepository->delete($user->id);
        }
    }

    public function search($searchKeyword)
    {
        return User::search($searchKeyword)->paginate(10);
    }
}