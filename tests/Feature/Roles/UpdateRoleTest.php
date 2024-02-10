<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateRoleTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_update_role()
    {
        $role = Role::create([
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ]);

        $data = [
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ];

        $response = $this->patch(route('web.roles.update', $role->id), [
            '_token' => $this->faker->text,
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        $this->assertDatabaseMissing('roles', $data);
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_update_role_if_not_allowed()
    {
        $user = User::factory()->create();

        $role = Role::create([
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ]);

        $data = [
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ];

        $response = $this->actingAs($user)->patch(route('web.roles.update', $role->id), [
            '_token' => $this->faker->text,
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        $this->assertDatabaseMissing('roles', $data);
        $response->assertForbidden();
    }

    public function test_allowed_user_cannot_update_role_with_empty_name(): void
    {
        $user = User::find(1);

        $role = Role::create([
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ]);

        $data = [
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ];

        $response = $this->actingAs($user)->patch(route('web.roles.update', $role->id), [
            '_token' => $this->faker->text,
            'name' => '',
            'description' => $data['description'],
        ]);

        $this->assertDatabaseMissing('roles', $data);
        $response->assertSessionHasErrors(['name' => 'Vui long nhap ten']);
    }

    public function test_allowed_user_cannot_update_role_with_empty_description(): void
    {
        $user = User::find(1);

        $role = Role::create([
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ]);

        $data = [
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ];

        $response = $this->actingAs($user)->patch(route('web.roles.update', $role->id), [
            '_token' => $this->faker->text,
            'name' => $data['name'],
            'description' => ''
        ]);

        $this->assertDatabaseMissing('roles', $data);
        $response->assertSessionHasErrors(['description' => 'Vui long nhap mo ta']);
    }

    public function test_allowed_user_can_update_role()
    {
        $user = User::find(1);

        $role = Role::create([
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ]);

        $data = [
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ];

        $response = $this->actingAs($user)->patch(route('web.roles.update', $role->id), [
            '_token' => $this->faker->text,
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        $this->assertDatabaseHas('roles', $data);
        $response->assertRedirect(route('web.roles.index'));
    }
}