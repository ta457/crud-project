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
}