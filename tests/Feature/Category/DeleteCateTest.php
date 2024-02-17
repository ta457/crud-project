<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteCateTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->delete(route('web.categories.destroy', $category->id));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_delete_category_if_not_allowed()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $response = $this->actingAs($user)->delete(route('web.categories.destroy', $category->id));

        $response->assertForbidden();
    }

    public function test_allowed_user_can_delete_category()
    {
        $user = User::find(1);

        $category = Category::factory()->create();

        $response = $this->actingAs($user)->delete(route('web.categories.destroy', $category->id));

        $this->assertDatabaseMissing('categories', [
            'name' => $category->name,
            'group' => $category->group,
            'description' => $category->description,
        ]);
        $response->assertRedirect(route('web.categories.index'));
    }
}