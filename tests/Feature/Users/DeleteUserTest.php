<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('web.users.destroy', $user->id));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_delete_user_if_not_allowed()
    {
        $user = User::factory()->create();

        $user2 = User::factory()->create();

        $response = $this->actingAs($user)->delete(route('web.users.destroy', $user2->id));

        $response->assertForbidden();
    }

    public function test_allowed_user_can_delete_user()
    {
        $user = User::find(1);

        $user2 = User::factory()->create();

        $countBefore = User::count();

        $response = $this->actingAs($user)->delete(route('web.users.destroy', $user2->id));

        $countAfter = User::count();

        $response->assertRedirect(route('web.users.index'));
        $this->assertDatabaseMissing('users', $user2->toArray());
        $this->assertEquals($countBefore - 1, $countAfter);
    }
}