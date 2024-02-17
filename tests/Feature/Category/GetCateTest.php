<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetCateTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_get_category()
    {
        $category = Category::factory()->create();

        $response = $this->get(route('web.categories.show', $category->id));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_get_category_if_not_allowed()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $response = $this->actingAs($user)->get(route('web.categories.show', $category->id));

        $response->assertForbidden();
    }

    public function test_allowed_user_can_get_category()
    {
        $user = User::find(1);

        $category = Category::factory()->create();

        $response = $this->actingAs($user)->get(route('web.categories.show', $category->id));

        $response->assertSuccessful();
        $response->assertViewIs('categories.show');
        $response->assertSee($category->name);
    }
}