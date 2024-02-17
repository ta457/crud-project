<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetUserListTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_get_user_list()
    {
        $response = $this->get(route('web.users.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_get_user_list_if_not_allowed()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('web.users.index'));

        $response->assertForbidden();
    }

    public function test_allowed_user_can_get_user_list()
    {
        $user = User::find(1);

        $users = User::factory(2)->create();

        $response = $this->actingAs($user)->get(route('web.users.index'));

        $response->assertSuccessful();
        $response->assertViewIs('users.index');
        $response->assertSee($users[0]->name);
        $response->assertSee($users[1]->name);
    }
}