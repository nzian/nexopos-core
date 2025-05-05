<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Ns\Classes\Hook;
use Ns\Models\Tax;
use Ns\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaxFactory extends Factory
{
    protected $model = Tax::class;

    public function definition()
    {
        return Hook::filter( 'ns-tax-factory', [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'rate' => $this->faker->numberBetween( 1, 20 ),
            'author' => $this->faker->randomElement( User::get()->map( fn( $user ) => $user->id ) ),
        ] );
    }
}
