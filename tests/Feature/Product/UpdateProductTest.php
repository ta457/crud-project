<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_update_product()
    {
        $product = Product::create($this->createProductData());

        $dataUpdate = $this->createProductData();

        $response = $this->patch(route('web.products.update', $product->id), $dataUpdate);

        $this->assertDatabaseMissing('products', ['name' => $dataUpdate['name']]);
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_update_product_if_not_allowed()
    {
        $user = User::factory()->create();
        $product = Product::create($this->createProductData());

        $dataUpdate = $this->createProductData();

        $response = $this->actingAs($user)->patch(route('web.products.update', $product->id), $dataUpdate);

        $this->assertDatabaseMissing('products', ['name' => $dataUpdate['name']]);
        $response->assertForbidden();
    }

    public function test_allowed_user_cannot_update_product_with_empty_name()
    {
        $user = User::find(1);
        $product = Product::create($this->createProductData());

        $dataUpdate = $this->createProductData(['name' => '']);

        $response = $this->actingAs($user)->patch(route('web.products.update', $product->id), $dataUpdate);

        $response->assertSessionHasErrors(['name' => 'Vui long nhap ten']);
    }

    public function test_allowed_user_cannot_update_product_with_empty_description()
    {
        $user = User::find(1);
        $product = Product::create($this->createProductData());

        $dataUpdate = $this->createProductData(['description' => '']);

        $response = $this->actingAs($user)->patch(route('web.products.update', $product->id), $dataUpdate);

        $response->assertSessionHasErrors(['description' => 'Vui long nhap mo ta']);
    }

    public function test_allowed_user_cannot_update_product_with_empty_price()
    {
        $user = User::find(1);
        $product = Product::create($this->createProductData());

        $dataUpdate = $this->createProductData(['price' => '']);

        $response = $this->actingAs($user)->patch(route('web.products.update', $product->id), $dataUpdate);

        $response->assertSessionHasErrors(['price' => 'Vui long nhap gia']);
    }

    public function test_allowed_user_cannot_update_product_with_empty_quantity()
    {
        $user = User::find(1);
        $product = Product::create($this->createProductData());

        $dataUpdate = $this->createProductData(['quantity' => '']);

        $response = $this->actingAs($user)->patch(route('web.products.update', $product->id), $dataUpdate);

        $response->assertSessionHasErrors(['quantity' => 'Vui long nhap so luong']);
    }

    public function test_allowed_user_can_update_product()
    {
        $user = User::find(1);
        $product = Product::create($this->createProductData());

        $dataUpdate = $this->createProductData();

        $response = $this->actingAs($user)->patch(route('web.products.update', $product->id), $dataUpdate);

        $this->assertDatabaseHas('products', ['name' => $dataUpdate['name']]);
        $response->assertRedirect(route('web.products.index'));
    }
}