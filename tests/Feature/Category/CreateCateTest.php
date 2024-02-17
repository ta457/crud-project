<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCateTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_create_category()
    {
        $response = $this->post(route('web.categories.store'), $this->createCategoryData());

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_create_category_if_not_allowed()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('web.categories.store'), $this->createCategoryData());

        $response->assertForbidden();
    }

    public function test_allowed_user_cannot_create_category_if_name_is_empty()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->post(route('web.categories.store'), $this->createCategoryData(['name' => '']));

        $response->assertSessionHasErrors(['name' => 'Name khong duoc de trong']);
    }

    public function test_allowed_user_cannot_create_category_if_group_is_empty()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->post(route('web.categories.store'), $this->createCategoryData(['group' => '']));

        $response->assertSessionHasErrors(['group' => 'Group khong duoc de trong']);
    }

    public function test_allowed_user_cannot_create_category_if_description_is_empty()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->post(route('web.categories.store'), $this->createCategoryData(['description' => '']));

        $response->assertSessionHasErrors(['description' => 'Description khong duoc de trong']);
    }

    public function test_allowed_user_can_create_category()
    {
        $user = User::find(1);

        $data = $this->createCategoryData();

        $countBefore = Category::count();

        $response = $this->actingAs($user)->post(route('web.categories.store'), $data);

        $countAfter = Category::count();

        $response->assertRedirect(route('web.categories.index'));
        $this->assertEquals($countBefore + 1, $countAfter);
        $this->assertDatabaseHas('categories', [
            'name' => $data['name'],
            'group' => $data['group'],
            'description' => $data['description']
        ]);
    }
}