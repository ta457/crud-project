<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;

    public function createRoleData($array = [])
    {
        return array_merge([
            '_token' => $this->faker->text,
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
        ], $array);
    }

    public function createUserData($array = [])
    {
        return array_merge([
            '_token' => $this->faker->text,
            'name' => $this->faker->name,
            'password' => $this->faker->password,
            'email' => $this->faker->word . '@gmail.com'
        ], $array);
    }

    public function createCategoryData($array = [])
    {
        return array_merge([
            '_token' => $this->faker->text,
            'name' => $this->faker->text,
            'group' => $this->faker->text,
            'description' => $this->faker->sentence(5),
        ], $array);
    }

    public function createProductData($array = [])
    {
        $category = Category::factory()->create();

        return array_merge([
            '_token' => $this->faker->text,
            'category_id' => $category->id,
            'name' => $this->faker->text,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomNumber(2),
            'quantity' => $this->faker->randomNumber(2),
        ], $array);
    }
}
