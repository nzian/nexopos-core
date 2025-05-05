<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Ns\Classes\Hook;
use Ns\Models\TaxGroup;
use Ns\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaxGroupFactory extends Factory
{
    protected $model = TaxGroup::class;

    public function definition()
    {
        return Hook::filter( 'tax-group', [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'author' => $this->faker->randomElement( User::get()->map( fn( $user ) => $user->id ) ),
        ] );
    }
}
