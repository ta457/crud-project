<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use WithFaker;

    public function test_unauthenticated_user_cannot_create_product()
    {
        $response = $this->post(route('web.products.store'), $this->createProductData());

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_cannot_create_product_if_not_allowed()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->post(route('web.products.store'), $this->createProductData());

        $response->assertForbidden();
    }

    public function test_allowed_user_cannot_create_product_with_empty_name()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)
            ->post(route('web.products.store'), $this->createProductData(['name' => '']));

        $response->assertSessionHasErrors(['name' => 'Vui long nhap ten']);
    }

    public function test_allowed_user_cannot_create_product_with_empty_description()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->post(route('web.products.store'), $this->createProductData(['description' => '']));

        $response->assertSessionHasErrors(['description' => 'Vui long nhap mo ta']);
    }

    public function test_allowed_user_cannot_create_product_with_empty_price()
    {
        $user = User::find(1);

        $response = $this->actingAs($user)
            ->post(route('web.products.store'), $this->createProductData(['price' => '']));

        $response->assertSessionHasErrors(['price' => 'Vui long nhap gia']);
    }

    public function test_allowed_user_cannot_create_product_with_empty_quantity()
    {
        $user = User::find(1);
        
        $response = $this->actingAs($user)
            ->post(route('web.products.store'), $this->createProductData(['quantity' => '']));

        $response->assertSessionHasErrors(['quantity' => 'Vui long nhap so luong']);
    }

    public function test_allowed_user_can_create_product()
    {
        $user = User::find(1);

        $data = $this->createProductData();

        $countBefore = Product::count();

        $response = $this->actingAs($user)->post(route('web.products.store'), $data);

        $countAfter = Product::count();

        $response->assertRedirect(route('web.products.index'));
        $this->assertDatabaseHas('products', [
            'name' => $data['name'],
        ]);
        $this->assertEquals($countBefore + 1, $countAfter);
    }
}