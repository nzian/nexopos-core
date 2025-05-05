<?php

namespace Database\Seeders;

use Ns\Models\Product;
use Ns\Models\ProductCategory;
use Ns\Models\ProductUnitQuantity;
use Ns\Models\UnitGroup;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return ProductCategory::factory()
            ->count( 2 )
            ->create()
            ->each( function ( $category ) {
                Product::factory()
                    ->count( 3 )
                    ->create( [ 'category_id' => $category->id ] )
                    ->each( function ( $product ) {
                        UnitGroup::find( $product->unit_group )->units->each( function ( $unit ) use ( $product ) {
                            ProductUnitQuantity::factory()
                                ->count( 1 )
                                ->create( [
                                    'product_id' => $product->id,
                                    'unit_id' => $unit->id,
                                ] );
                        } );
                    } );
            } );
    }
}
