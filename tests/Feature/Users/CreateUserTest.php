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
        $response = $this->post(route('web.users.store'), [
            '_token' => $this->faker->text,
            'name' => $this->faker->name,
            'password' => $this->faker->password,
            'email' => $this->faker->email
        ]);

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_create_user_if_not_allowed()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('web.users.store'), [
            '_token' => $this->faker->text,
            'name' => $this->faker->name,
            'password' => $this->faker->password,
            'email' => $this->faker->email
        ]);

        $response->assertForbidden();
    }

    public function test_allowed_user_cannot_create_user_with_non_gmail()
    {
        $user = User::find(1);

        $countBefore = User::count();

        $response = $this->actingAs($user)->post(route('web.users.store'), [
            '_token' => $this->faker->text,
            'name' => $this->faker->name,
            'password' => $this->faker->password,
            'email' => 'test@example.com'
        ]);

        $countAfter = User::count();

        $this->assertEquals($countBefore, $countAfter);
        $response->assertSessionHasErrors(['email' => 'The email must be a Gmail address.']);
    }

    public function test_allowed_user_cannot_create_user_with_empty_name()
    {
        $user = User::find(1);

        $countBefore = User::count();

        $response = $this->actingAs($user)->post(route('web.users.store'), [
            '_token' => $this->faker->text,
            'name' => '',
            'password' => 'test@gmail.com',
            'email' => $this->faker->email
        ]);

        $countAfter = User::count();

        $this->assertEquals($countBefore, $countAfter);
        $response->assertSessionHasErrors(['name' => 'Name khong duoc de trong']);
    }

    public function test_allowed_user_cannot_create_user_with_empty_password()
    {
        $user = User::find(1);

        $countBefore = User::count();

        $response = $this->actingAs($user)->post(route('web.users.store'), [
            '_token' => $this->faker->text,
            'name' => $this->faker->name,
            'password' => '',
            'email' => $this->faker->word . '@gmail.com'
        ]);

        $countAfter = User::count();

        $this->assertEquals($countBefore, $countAfter);
        $response->assertSessionHasErrors(['password' => 'Password khong duoc de trong']);
    }

    public function test_allowed_user_cannot_create_user_with_empty_email()
    {
        $user = User::find(1);

        $countBefore = User::count();

        $response = $this->actingAs($user)->post(route('web.users.store'), [
            '_token' => $this->faker->text,
            'name' => $this->faker->name,
            'password' => $this->faker->password,
            'email' => ''
        ]);

        $countAfter = User::count();

        $this->assertEquals($countBefore, $countAfter);
        $response->assertSessionHasErrors(['email' => 'Email khong duoc de trong']);
    }

    public function test_allowed_user_can_create_user()
    {
        $user = User::find(1);

        $data = [
            '_token' => $this->faker->text,
            'name' => $this->faker->name,
            'password' => $this->faker->password,
            'email' => $this->faker->word . '@gmail.com'
        ];

        $countBefore = User::count();

        $response = $this->actingAs($user)->post(route('web.users.store'), $data);

        $countAfter = User::count();

        $response->assertRedirect(route('web.users.index'));
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
        $this->assertEquals($countBefore + 1, $countAfter);
    }
}
