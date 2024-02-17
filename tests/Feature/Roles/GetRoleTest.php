<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetRoleTest extends TestCase
{
    use WithFaker;
    
    public function test_unauthenticated_user_cannot_get_role()
    {
        $role = Role::factory()->create();

        $response = $this->get(route('web.roles.show', $role->id));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_get_role_if_not_allowed()
    {
        $user = User::factory()->create();

        $role = Role::factory()->create();

        $response = $this->actingAs($user)->get(route('web.roles.show', $role->id));

        $response->assertForbidden();
    }

    public function test_allowed_user_can_get_role()
    {
        $user = User::find(1);

        $role = Role::factory()->create();

        $response = $this->actingAs($user)->get(route('web.roles.show', $role->id));

        $response->assertSuccessful();
        $response->assertViewIs('roles.show');
        $response->assertSee($role->name);
    }
}