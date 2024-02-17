<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetUserTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_get_user()
    {
        $user = User::factory()->create();

        $response = $this->get(route('web.users.show', $user->id));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_get_user_if_not_allowed()
    {
        $user = User::factory()->create();

        $user2 = User::factory()->create();

        $response = $this->actingAs($user)->get(route('web.users.show', $user2->id));

        $response->assertForbidden();
    }

    public function test_allowed_user_can_get_user()
    {
        $user = User::find(1);

        $user2 = User::factory()->create();

        $response = $this->actingAs($user)->get(route('web.users.show', $user2->id));

        $response->assertSuccessful();
        $response->assertViewIs('users.show');
        $response->assertSee($user2->name);
    }
}