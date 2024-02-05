<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use WithFaker;

    public function test_cannot_create_user_with_non_gmail(): void
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
}
