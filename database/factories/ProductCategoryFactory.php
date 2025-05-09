<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Ns\Classes\Hook;
use Ns\Models\ProductCategory;
use Ns\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    protected $model = ProductCategory::class;

    public function definition()
    {
        return Hook::filter( 'ns-product-category-factory', [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'displays_on_pos' => $this->faker->randomElement( [ true, false ] ),
            'author' => $this->faker->randomElement( User::get()->map( fn( $user ) => $user->id ) ),
        ] );
    }
}
