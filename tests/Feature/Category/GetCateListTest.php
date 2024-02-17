<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetCateListTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_get_category_list()
    {
        $response = $this->get(route('web.categories.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_get_category_list_if_not_allowed()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('web.categories.index'));

        $response->assertForbidden();
    }

    public function test_allowed_user_can_get_category_list()
    {
        $user = User::find(1);

        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $response = $this->actingAs($user)->get(route('web.categories.index'));

        $response->assertSuccessful();
        $response->assertViewIs('categories.index');
        $response->assertSee($category1->name);
        $response->assertSee($category2->name);
    }
}