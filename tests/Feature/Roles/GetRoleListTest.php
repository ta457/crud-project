<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetRoleListTest extends TestCase
{
    use WithFaker;
    
    public function test_unauthenticated_user_cannot_get_role_list()
    {
        $response = $this->get(route('web.roles.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_get_role_list_if_not_admin()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('web.roles.index'));

        $response->assertForbidden();
    }

    public function test_admin_can_get_role_list()
    {
        $user = User::find(1);

        $role1 = Role::create([
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ]);

        $role2 = Role::create([
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ]);

        $response = $this->actingAs($user)->get(route('web.roles.index'));

        $response->assertSuccessful();
        $response->assertViewIs('roles.index');
        $response->assertSee($role1->name);
        $response->assertSee($role2->name);
    }
}