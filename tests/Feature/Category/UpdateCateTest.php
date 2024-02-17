<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateCateTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_update_category()
    {
        $category = Category::factory()->create();

        $data = $this->createCategoryData();

        $response = $this->patch(route('web.categories.update', $category->id), $data);

        $this->assertDatabaseMissing('categories', [
            'name' => $data['name'],
            'group' => $data['group'],
            'description' => $data['description'],
        ]);
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_update_category_if_not_allowed()
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $data = $this->createCategoryData();

        $response = $this->actingAs($user)
            ->patch(route('web.categories.update', $category->id), $data);

        $this->assertDatabaseMissing('categories', [
            'name' => $data['name'],
            'group' => $data['group'],
            'description' => $data['description'],
        ]);
        $response->assertForbidden();
    }

    public function test_allowed_user_cannot_update_category_if_name_is_empty()
    {
        $user = User::find(1);

        $category = Category::factory()->create();

        $response = $this->actingAs($user)
            ->patch(route('web.categories.update', $category->id), 
                $this->createCategoryData(['name' => ''])
        );

        $response->assertSessionHasErrors(['name' => 'Name khong duoc de trong']);
    }

    public function test_allowed_user_cannot_update_category_if_group_is_empty()
    {
        $user = User::find(1);

        $category = Category::factory()->create();

        $response = $this->actingAs($user)
            ->patch(route('web.categories.update', $category->id), 
                $this->createCategoryData(['group' => ''])
        );

        $response->assertSessionHasErrors(['group' => 'Group khong duoc de trong']);
    }

    public function test_allowed_user_cannot_update_category_if_description_is_empty()
    {
        $user = User::find(1);

        $category = Category::factory()->create();

        $response = $this->actingAs($user)
            ->patch(route('web.categories.update', $category->id), 
                $this->createCategoryData(['description' => ''])
        );

        $response->assertSessionHasErrors(['description' => 'Description khong duoc de trong']);
    }

    public function test_allowed_user_can_update_category()
    {
        $user = User::find(1);

        $category = Category::factory()->create();

        $data = $this->createCategoryData();

        $response = $this->actingAs($user)
            ->patch(route('web.categories.update', $category->id), $data);

        $response->assertRedirect(route('web.categories.index'));
        $this->assertDatabaseHas('categories', [
            'name' => $data['name'],
            'group' => $data['group'],
            'description' => $data['description'],
        ]);
    }
}