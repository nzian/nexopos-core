<?php

namespace Database\Seeders;

use Ns\Models\Provider;
use Ns\Models\Role;
use Illuminate\Database\Seeder;

class DefaultProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Provider::create( [
            'first_name' => __( 'Default Provider' ),
            'author' => Role::namespace( Role::ADMIN )->users->first()->id,
        ] );
    }
}
