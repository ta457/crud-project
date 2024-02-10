<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetPermTest extends TestCase
{
    public function test_unauthenticated_user_cannot_get_perm()
    {
        $response = $this->get(route('web.permissions.show', 1));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_get_perm_if_not_allowed()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('web.permissions.show', 1));

        $response->assertForbidden();
    }

    public function test_allowed_user_can_get_perm()
    {
        $user = User::find(1);

        $perm1 = Permission::find(1);

        $response = $this->actingAs($user)->get(route('web.permissions.show', $perm1->id));

        $response->assertSuccessful();
        $response->assertViewIs('permissions.show');
        $response->assertSee($perm1->name);
    }
}