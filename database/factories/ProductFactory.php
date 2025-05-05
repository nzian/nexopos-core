<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Ns\Classes\Hook;
use Ns\Models\Product;
use Ns\Models\TaxGroup;
use Ns\Models\UnitGroup;
use Ns\Models\User;
use Ns\Services\TaxService;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $unitGroup = $this->faker->randomElement( UnitGroup::get() );

        /**
         * @var TaxService
         */
        $taxType = $this->faker->randomElement( [ 'inclusive', 'exclusive' ] );
        $taxGroup = TaxGroup::get()->first();

        return Hook::filter( 'ns-product', [
            'name' => $this->faker->word,
            'product_type' => 'product',
            'barcode' => $this->faker->word,
            'tax_type' => $taxType,
            'tax_group_id' => $taxGroup->id, // assuming there is only one group
            'stock_management' => $this->faker->randomElement( [ 'enabled', 'disabled' ] ),
            'barcode_type' => $this->faker->randomElement( [ 'ean13' ] ),
            'sku' => $this->faker->word . date( 's' ),
            'type' => $this->faker->randomElement( [ 'materialized', 'dematerialized'] ),
            'unit_group' => $unitGroup->id,
            'author' => $this->faker->randomElement( User::get()->map( fn( $user ) => $user->id ) ),
        ] );
    }
}
