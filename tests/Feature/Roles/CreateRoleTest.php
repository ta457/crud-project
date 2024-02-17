<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateRoleTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_create_role()
    {
        $response = $this->post(route('web.roles.store'), $this->createRoleData());

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_create_role_if_not_allowed()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('web.roles.store'), $this->createRoleData());

        $response->assertForbidden();
    }

    public function test_allowed_user_cannot_create_role_with_empty_name(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->post(route('web.roles.store'), $this->createRoleData(['name' => '']));

        $response->assertSessionHasErrors(['name' => 'Name khong duoc de trong']);
    }

    public function test_allowed_user_cannot_create_role_with_empty_description(): void
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->post(route('web.roles.store'), $this->createRoleData(['description' => '']));

        $response->assertSessionHasErrors(['description' => 'Description khong duoc de trong']);
    }

    public function test_allowed_user_can_create_role()
    {
        $user = User::find(1);

        $data = $this->createRoleData();

        $countBefore = Role::count();

        $response = $this->actingAs($user)->post(route('web.roles.store'), $data);

        $countAfter = Role::count();

        $response->assertRedirect(route('web.roles.index'));
        $this->assertDatabaseHas('roles', ['name' => $data['name']]);
        $this->assertEquals($countBefore + 1, $countAfter);
    }
}
