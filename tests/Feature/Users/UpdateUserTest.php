<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_update_user()
    {
        $user = User::factory()->create();

        $response = $this->patch(route('web.users.update', $user->id), $this->createUserData());

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_update_user_if_not_allowed()
    {
        $user = User::factory()->create();

        $user2 = User::factory()->create();

        $response = $this->actingAs($user)
            ->patch(route('web.users.update', $user2->id), $this->createUserData());

        $response->assertForbidden();
    }

    public function test_allowed_user_cannot_update_user_with_empty_name()
    {
        $user = User::find(1);

        $user2 = User::factory()->create();

        $response = $this->actingAs($user)
            ->patch(route('web.users.update', $user2->id), $this->createUserData(['name' => '']));

        $response->assertSessionHasErrors(['name' => 'Name khong duoc de trong']);

        $this->assertDatabaseHas('users', $user2->toArray());
    }

    public function test_allowed_user_cannot_update_user_with_empty_password()
    {
        $user = User::find(1);

        $user2 = User::factory()->create();

        $response = $this->actingAs($user)
            ->patch(route('web.users.update', $user2->id), $this->createUserData(['password' => '']));

        $response->assertSessionHasErrors(['password' => 'Password khong duoc de trong']);

        $this->assertDatabaseHas('users', $user2->toArray());
    }

    public function test_allowed_user_cannot_update_user_with_empty_email()
    {
        $user = User::find(1);

        $user2 = User::factory()->create();

        $response = $this->actingAs($user)
            ->patch(route('web.users.update', $user2->id), $this->createUserData(['email' => '']));

        $response->assertSessionHasErrors(['email' => 'Email khong duoc de trong']);

        $this->assertDatabaseHas('users', $user2->toArray());
    }

    public function test_allowed_user_can_update_user()
    {
        $user = User::find(1);

        $user2 = User::factory()->create();

        $data = $this->createUserData();

        $response = $this->actingAs($user)
            ->patch(route('web.users.update', $user2->id), $data);

        $response->assertRedirect(route('web.users.index'));

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email']
        ]);
    }
}