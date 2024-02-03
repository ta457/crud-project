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
        $role = Role::create([
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ]);

        $response = $this->get(route('web.roles.show', $role->id));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_get_role_if_not_admin()
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ]);

        $response = $this->actingAs($user)->get(route('web.roles.show', $role->id));

        $response->assertForbidden();
    }

    public function test_admin_can_get_role()
    {
        $user = User::find(1);

        $role = Role::create([
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ]);

        $response = $this->actingAs($user)->get(route('web.roles.show', $role->id));

        $response->assertSuccessful();
        $response->assertViewIs('roles.show');
        $response->assertSee($role->name);
    }
}