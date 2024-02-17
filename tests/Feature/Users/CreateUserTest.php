<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_create_user()
    {
        $response = $this->post(route('web.users.store'), $this->createUserData());

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_create_user_if_not_allowed()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('web.users.store'), $this->createUserData());

        $response->assertForbidden();
    }

    public function test_allowed_user_cannot_create_user_with_empty_name()
    {
        $user = User::find(1);

        $countBefore = User::count();

        $response = $this->actingAs($user)
            ->post(route('web.users.store'), $this->createUserData(['name' => '']));

        $countAfter = User::count();

        $this->assertEquals($countBefore, $countAfter);
        $response->assertSessionHasErrors(['name' => 'Name khong duoc de trong']);
    }

    public function test_allowed_user_cannot_create_user_with_empty_password()
    {
        $user = User::find(1);

        $countBefore = User::count();

        $response = $this->actingAs($user)
            ->post(route('web.users.store'), $this->createUserData(['password' => '']));

        $countAfter = User::count();

        $this->assertEquals($countBefore, $countAfter);
        $response->assertSessionHasErrors(['password' => 'Password khong duoc de trong']);
    }

    public function test_allowed_user_cannot_create_user_with_empty_email()
    {
        $user = User::find(1);

        $countBefore = User::count();

        $response = $this->actingAs($user)
            ->post(route('web.users.store'), $this->createUserData(['email' => '']));

        $countAfter = User::count();

        $this->assertEquals($countBefore, $countAfter);
        $response->assertSessionHasErrors(['email' => 'Email khong duoc de trong']);
    }

    public function test_allowed_user_cannot_create_user_with_non_gmail()
    {
        $user = User::find(1);

        $countBefore = User::count();

        $response = $this->actingAs($user)
            ->post(route('web.users.store'), $this->createUserData(['email' => 'test@example.com']));

        $countAfter = User::count();

        $this->assertEquals($countBefore, $countAfter);
        $response->assertSessionHasErrors(['email' => 'The email must be a Gmail address.']);
    }

    public function test_allowed_user_can_create_user()
    {
        $user = User::find(1);

        $data = $this->createUserData();

        $countBefore = User::count();

        $response = $this->actingAs($user)->post(route('web.users.store'), $data);

        $countAfter = User::count();

        $response->assertRedirect(route('web.users.index'));
        $this->assertDatabaseHas('users', ['name' => $data['name']]);
        $this->assertEquals($countBefore + 1, $countAfter);
    }
}
