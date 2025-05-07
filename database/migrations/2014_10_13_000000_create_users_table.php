<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Determine whether the migration
     * should execute when we're accessing
     * a multistore instance.
     */
    public function runOnMultiStore()
    {
        return false;
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('users')) {
            Schema::table( 'users', function ( Blueprint $table ) {
                if ( ! Schema::hasColumn( 'users', 'first_name' ) ) {
                    $table->string( 'first_name' )->nullable();
                }
                
                if ( ! Schema::hasColumn( 'users', 'username' ) ) {
                    $table->string( 'username' )->nullable();
                }

                if ( ! Schema::hasColumn( 'users', 'last_name' ) ) {
                    $table->string( 'last_name' )->nullable();
                }

                if ( ! Schema::hasColumn( 'users', 'gender' ) ) {
                    $table->string( 'gender' )->nullable();
                }

                if ( ! Schema::hasColumn( 'users', 'phone' ) ) {
                    $table->string( 'phone' )->nullable();
                }

                if ( ! Schema::hasColumn( 'users', 'pobox' ) ) {
                    $table->string( 'pobox' )->nullable();
                }

                if ( ! Schema::hasColumn( 'users', 'activation_expiration' ) ) {
                    $table->datetime( 'activation_expiration' )->nullable();
                }

                if ( ! Schema::hasColumn( 'users', 'activation_token' ) ) {
                    $table->string( 'activation_token' )->nullable();
                }

                if ( ! Schema::hasColumn( 'users', 'birth_date' ) ) {
                    $table->datetime( 'birth_date' )->nullable();
                }

                if ( ! Schema::hasColumn( 'users', 'active' ) ) {
                    $table->boolean( 'active' )->default( false );
                }

                if ( ! Schema::hasColumn( 'users', 'author' ) ) {
                    $table->integer( 'author' )->nullable();
                }

                if ( ! Schema::hasColumn( 'users', 'store_id' ) ) {
                    $table->string( 'name' )->nullable()->change();
                }
            } );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                if (Schema::hasColumn('users', 'first_name')) {
                    $table->dropColumn('first_name');
                }
                if (Schema::hasColumn('users', 'last_name')) {
                    $table->dropColumn('last_name');
                }
                if (Schema::hasColumn('users', 'gender')) {
                    $table->dropColumn('gender');
                }
                if (Schema::hasColumn('users', 'phone')) {
                    $table->dropColumn('phone');
                }
                if (Schema::hasColumn('users', 'pobox')) {
                    $table->dropColumn('pobox');
                }
                if (Schema::hasColumn('users', 'activation_expiration')) {
                    $table->dropColumn('activation_expiration');
                }
                if (Schema::hasColumn('users', 'activation_token')) {
                    $table->dropColumn('activation_token');
                }
                if (Schema::hasColumn('users', 'birth_date')) {
                    $table->dropColumn('birth_date');
                }
                if (Schema::hasColumn('users', 'active')) {
                    $table->dropColumn('active');
                }
                if (Schema::hasColumn('users', 'author')) {
                    $table->dropColumn('author');
                }
            });
        }
    }
};
