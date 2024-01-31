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
            'name' => 'Superadmin',
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
            'name' => 'super-admin',
            'description' => 'super admin'
        ]);

        $userRole = Role::create([
            'name' => 'user',
            'description' => 'user'
        ]);

        // create permissions ====================================================
        // role CRUD permissions
        $viewRole = Permission::create([
            'name' => 'view-roles',
            'description' => 'can view role list'
        ]);
        $createRole = Permission::create([
            'name' => 'create-role',
            'description' => 'can create role'
        ]);
        $updateRole = Permission::create([
            'name' => 'update-role',
            'description' => 'can update role'
        ]);
        $deleteRole = Permission::create([
            'name' => 'delete-role',
            'description' => 'can delete role'
        ]);

        // permission CRUD permissions
        $viewPerm = Permission::create([
            'name' => 'view-permissions',
            'description' => 'can view permission list'
        ]);
        $createPerm = Permission::create([
            'name' => 'create-permission',
            'description' => 'can create permission'
        ]);
        $updatePerm = Permission::create([
            'name' => 'update-permission',
            'description' => 'can update permission'
        ]);
        $deletePerm = Permission::create([
            'name' => 'delete-permission',
            'description' => 'can delete permission'
        ]);

        // user CRUD permissions
        $viewUser = Permission::create([
            'name' => 'view-users',
            'description' => 'can view user list'
        ]);
        $createUser = Permission::create([
            'name' => 'create-user',
            'description' => 'can create user'
        ]);
        $updateUser = Permission::create([
            'name' => 'update-user',
            'description' => 'can update user'
        ]);
        $deleteUser = Permission::create([
            'name' => 'delete-user',
            'description' => 'can delete user'
        ]);

        // category CRUD permissions
        $viewCate = Permission::create([
            'name' => 'view-categories',
            'description' => 'can view category list'
        ]);
        $createCate = Permission::create([
            'name' => 'create-category',
            'description' => 'can create category'
        ]);
        $updateCate = Permission::create([
            'name' => 'update-category',
            'description' => 'can update category'
        ]);
        $deleteCate = Permission::create([
            'name' => 'delete-category',
            'description' => 'can delete category'
        ]);

        // product CRUD permissions
        $viewProd = Permission::create([
            'name' => 'view-products',
            'description' => 'can view product list'
        ]);
        $createProd = Permission::create([
            'name' => 'create-product',
            'description' => 'can create product'
        ]);
        $updateProd = Permission::create([
            'name' => 'update-product',
            'description' => 'can update product'
        ]);
        $deleteProd = Permission::create([
            'name' => 'delete-product',
            'description' => 'can delete product'
        ]);

        // assign roles to accounts =================================================

        $admin->roles()->attach($supAdminRole);
        
        $user->roles()->attach($userRole);

        // assign permissions to roles ==============================================

        $userRole->permissions()->attach([
            $viewProd->id,
            $createProd->id,
            $updateProd->id,
            $deleteProd->id
        ]);
    }
}
