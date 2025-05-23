<?php

namespace Database\Factories;

use Ns\Classes\Hook;
use Ns\Models\CustomerShippingAddress;
use Ns\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Ns\Models\Model>
 */
class CustomerShippingAddressFactory extends Factory
{
    protected $model = CustomerShippingAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $email = $this->faker->email();

        return Hook::filter( 'ns-customer-shipping-factory', [
            'type' => 'shipping',
            'email' => $email,
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone' => $this->faker->phoneNumber(),
            'address_1' => $this->faker->streetAddress(),
            'address_2' => $this->faker->streetAddress(),
            'country' => $this->faker->country(),
            'city' => $this->faker->city(),
            'pobox' => $this->faker->postcode(),
            'author' => User::get()->random()->id,
        ] );
    }
}
