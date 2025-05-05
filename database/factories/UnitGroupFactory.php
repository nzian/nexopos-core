<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Ns\Classes\Hook;
use Ns\Models\UnitGroup;
use Ns\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitGroupFactory extends Factory
{
    protected $model = UnitGroup::class;

    public function definition()
    {
        return Hook::filter( 'ns-unit-group', [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'author' => $this->faker->randomElement( User::get()->map( fn( $user ) => $user->id ) ),
        ] );
    }
}
