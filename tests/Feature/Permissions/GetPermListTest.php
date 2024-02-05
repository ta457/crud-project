<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetPermListTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_get_perm_list()
    {
        $response = $this->get(route('web.permissions.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_get_perm_list_if_not_admin()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('web.permissions.index'));

        $response->assertForbidden();
    }

    public function test_admin_can_get_perm_list()
    {
        $user = User::find(1);

        $perm1 = Permission::find(1);
        $perm2 = Permission::find(2);

        $response = $this->actingAs($user)->get(route('web.permissions.index'));

        $response->assertSuccessful();
        $response->assertViewIs('permissions.index');
        $response->assertSee($perm1->name);
        $response->assertSee($perm2->name);
    }
}