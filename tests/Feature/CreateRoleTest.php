<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateRoleTest extends TestCase
{
    use WithFaker;

    public function test_authenticated_user_cannot_create_role_with_empty_name(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('web.roles.store'), [
            '_token' => $this->faker->text,
            'name' => '',
            'description' => 'test',
        ]);

        $response->assertSessionHasErrors(['name' => 'Ten khong duoc de trong']);
    }

    public function test_authenticated_user_cannot_create_role_with_empty_description(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('web.roles.store'), [
            '_token' => $this->faker->text,
            'name' => 'test',
            'description' => '',
        ]);

        $response->assertSessionHasErrors(['description' => 'Description khong duoc de trong']);
    }
}
