<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function assignRoles($user, $roles)
    {
        $user->roles()->sync($roles);
    }

    public function getLatestUsers()
    {
        return $this->model->latest()->paginate(10);
    }

    public function resetPassword($user)
    {
        $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 8);

        $user->update(['password' => bcrypt($password)]);

        return $password;
    }

    public function search($searchKeyword, $roleId = null)
    {
        return $this->model->search($searchKeyword, $roleId);
    }
}