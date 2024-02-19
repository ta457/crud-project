<?php

namespace App\Services;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\Email;
use App\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

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
        try {
            $user = $this->userRepository->create($request->validated());
            $this->assignRolesFromRequest($user, $request);
            Alert::success('Success', 'User created successfully!');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
        }
    }

    public function updateUser(UpdateUserRequest $request, User $user)
    {
        if ($user->id !== 1) {
            $this->userRepository->update($request->validated(), $user->id);
            $this->assignRolesFromRequest($user, $request);
            Alert::success('Success', 'User updated successfully!');
        }
    }

    public function deleteUser(User $user)
    {
        if ($user->id !== 1) {
            $this->userRepository->delete($user->id);
            Alert::success('Success', 'User deleted successfully!');
        } else {
            Alert::error('Error', 'You are not allowed to delete this user!');
        }
    }

    public function search($searchKeyword, $roleId = null)
    {
        // return User::search($searchKeyword, $roleId)->paginate(10);
        return $this->userRepository->search($searchKeyword, $roleId)->paginate(10);
    }

    public function resetPassword(User $user)
    {
        $password = $this->userRepository->resetPassword($user);

        try {
            Mail::to($user->email)->send(new Email($password));
            Alert::success('Success', 'Password reset successfully! Email sent to user.');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Password reset successfully! Email failed to send.');
        }
    }
}