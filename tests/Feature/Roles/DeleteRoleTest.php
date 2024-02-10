<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteRoleTest extends TestCase
{
    use WithFaker;
    
    public function test_unauthenticated_user_cannot_delete_role()
    {
        $role = Role::create([
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ]);

        $response = $this->delete(route('web.roles.destroy', $role->id));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_delete_role_if_not_allowed()
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ]);

        $response = $this->actingAs($user)->delete(route('web.roles.destroy', $role->id));

        $response->assertForbidden();
    }

    public function test_allowed_user_can_delete_role()
    {
        $user = User::find(1);

        $role = Role::create([
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ]);

        $countBefore = Role::count();

        $response = $this->actingAs($user)->delete(route('web.roles.destroy', $role->id));

        $countAfter = Role::count();

        $response->assertRedirect(route('web.roles.index'));
        $this->assertDatabaseMissing('roles', $role->toArray());
        $this->assertEquals($countBefore - 1, $countAfter);
    }
}