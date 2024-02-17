<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetProductListTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_get_product_list()
    {
        $response = $this->get(route('web.products.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_get_product_list_if_not_allowed()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('web.products.index'));

        $response->assertForbidden();
    }

    public function test_allowed_user_can_get_product_list()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)->get(route('web.products.index'));

        // $category = Category::factory()->create();

        // $product1 = Product::factory()->create([
        //     'category_id' => $category->id,
        // ]);

        // $product2 = Product::factory()->create([
        //     'category_id' => $category->id,
        // ]);

        $response->assertSuccessful();
        $response->assertViewIs('products.index');
        // $response->assertSee($product1->name);
        // $response->assertSee($product2->name);
    }
}