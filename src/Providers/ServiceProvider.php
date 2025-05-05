<?php
namespace Ns\Providers;

use App\Providers\ModulesServiceProvider;
use Illuminate\Support\ServiceProvider as CoreServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
/**
 * Class Provider
 *
 * @package Ns\Providers
 */
class ServiceProvider extends CoreServiceProvider
{
    public function register()
    {
        $this->app->register( AppServiceProvider::class );
        $this->app->register( AuthServiceProvider::class );
        $this->app->register( CrudServiceProvider::class );
        $this->app->register( EventServiceProvider::class );
        $this->app->register( FileSystemServiceProvider::class );
        $this->app->register( FormsProvider::class );
        $this->app->register( LocalizationServiceProvider::class );
        // $this->app->register( ModulesServiceProvider::class );
        $this->app->register( RouteServiceProvider::class );
        $this->app->register( SettingsPageProvider::class );
        $this->app->register( WidgetsServiceProvider::class );
    }

    public function boot()
    {
        $this->publishesMigrations([
            __DIR__ . '/../../database/migrations' => database_path( 'migrations' ),
        ]);

        $this->loadJsonTranslationsFrom ( __DIR__ . '/../lang' );

        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'Ns');

        if ( $this->app->runningInConsole() ) {
            // ...
        }

        // $this->loadRoutesFrom( __DIR__ . '/../../routes/web.php' );
        // $this->loadRoutesFrom( __DIR__ . '/../../routes/web.php' );
    }
}