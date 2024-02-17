<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_delete_product()
    {
        $product = Product::create($this->createProductData());

        $response = $this->delete(route('web.products.destroy', $product->id));

        $this->assertDatabaseHas('products', ['name' => $product->name]);
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_delete_product_if_not_allowed()
    {
        $user = User::factory()->create();
        $product = Product::create($this->createProductData());

        $response = $this->actingAs($user)->delete(route('web.products.destroy', $product->id));

        $this->assertDatabaseHas('products', ['name' => $product->name]);
        $response->assertForbidden();
    }

    public function test_allowed_user_can_delete_product()
    {
        $user = User::find(1);
        $product = Product::create($this->createProductData());

        $countBefore = Product::count();

        $response = $this->actingAs($user)->delete(route('web.products.destroy', $product->id));

        $countAfter = Product::count();

        $this->assertDatabaseMissing('products', ['name' => $product->name]);
        $this->assertEquals($countBefore - 1, $countAfter);
        $response->assertRedirect(route('web.products.index'));
    }
}