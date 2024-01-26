<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create super admin & user accounts ====================================

        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '11111111'
        ]);

        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => '11111111'
        ]);

        // create super admin & user roles ======================================

        $supAdminRole = Role::create([
            'name' => 'super admin',
            'description' => 'super admin'
        ]);

        $userRole = Role::create([
            'name' => 'user',
            'description' => 'user'
        ]);

        // create permissions ====================================================
        // user CRUD permissions
        $viewUser = Permission::create([
            'name' => 'view users',
            'description' => 'can view user list'
        ]);

        $createUser = Permission::create([
            'name' => 'create user',
            'description' => 'can create user'
        ]);

        $updateUser = Permission::create([
            'name' => 'update user',
            'description' => 'can update user'
        ]);

        $deleteUser = Permission::create([
            'name' => 'delete user',
            'description' => 'can delete user'
        ]);

        // category CRUD permissions
        $viewCate = Permission::create([
            'name' => 'view categories',
            'description' => 'can view category list'
        ]);

        $createCate = Permission::create([
            'name' => 'create category',
            'description' => 'can create category'
        ]);

        $updateCate = Permission::create([
            'name' => 'update category',
            'description' => 'can update category'
        ]);

        $deleteCate = Permission::create([
            'name' => 'delete category',
            'description' => 'can delete category'
        ]);

        // assign roles to accounts =================================================

        $admin->roles()->attach($supAdminRole);
        
        $user->roles()->attach($userRole);

        // assign permissions to roles ==============================================

        $userRole->permissions()->attach([
            $viewCate->id,
            $createCate->id,
            $updateCate->id,
            $deleteCate->id
        ]);
    }
}
