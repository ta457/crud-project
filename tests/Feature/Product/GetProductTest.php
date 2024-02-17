<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class GetProductTest extends TestCase
{
    use WithFaker;

    public function test_user_can_get_product_data()
    {
        $product = Product::create($this->createProductData());

        $response = $this->getJson(route('products.show', $product->id));

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJson(
            fn (AssertableJson $json) => $json->has(
                'data',
                fn(AssertableJson $json) => $json->has('id')->has('category')->has('name')->has('description')->etc()
            )->where('message', 'Product retrieved successfully.')
        );
    }
}