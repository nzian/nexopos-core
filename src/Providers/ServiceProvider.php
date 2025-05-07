<?php
namespace Ns\Providers;

use Illuminate\Support\ServiceProvider as CoreServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Ns\Classes\NsViteDirective;
use Ns\Console\Commands\ExtractTranslation;
use Ns\Console\Commands\InstallCommand;
use Ns\View\Components\SessionMessage;
use Ns\Services\Helper;
use App\Events\ApiRouteLoadedEvent;

/**
 * Class Provider
 *
 * @package Ns\Providers
 */
class ServiceProvider extends CoreServiceProvider
{
    public function register()
    {
        /**
         * We need to check if the database is installed.
         * If it's the case, we can register the service providers.
         */
        $this->app->register( AppServiceProvider::class );
        
        if ( Helper::checkDatabaseExistence() ) {
            $this->app->register( AuthServiceProvider::class );
            $this->app->register( CrudServiceProvider::class );
            $this->app->register( EventServiceProvider::class );
            $this->app->register( FileSystemServiceProvider::class );
            $this->app->register( FormsProvider::class );
            $this->app->register( LocalizationServiceProvider::class );
            $this->app->register( ModulesServiceProvider::class );
            $this->app->register( RouteServiceProvider::class );
            $this->app->register( SettingsPageProvider::class );
            $this->app->register( WidgetsServiceProvider::class ); 
            
            $this->app->singleton( 'ns.installed', function () {
                return true;
            });
        } else {
            $this->app->singleton( 'ns.installed', function () {
                return false;
            });
        }

        define( 'NS_ROOT', __DIR__ . '/../../' );
    }

    public function boot()
    {
        $this->publishesMigrations([
            __DIR__ . '/../../database/migrations' => database_path( 'migrations' ),
        ]);

        $this->publishes([
            __DIR__ . '/../../public' => public_path( 'vendor/ns' ),
        ], 'nexopos-assets' );

        $this->publishes([
            __DIR__ . '/../../config/nexopos.php' => config_path( 'nexopos.php' ),
        ], 'nexopos-config' );

        $this->publishes([
            __DIR__ . '/../../database/permissions' => database_path( 'permissions' ),
        ], 'nexopos-permissions' );

        $this->loadJsonTranslationsFrom ( __DIR__ . '/../lang' );

        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'ns');

        if ( $this->app->runningInConsole() ) {
            // ...
        }

        Route::middleware( 'web' )->group( function() {
            $this->loadRoutesFrom( __DIR__ . '/../../routes/web.php' );
        });

        // Route::prefix( 'api' )->group( function() {
        //     $this->loadRoutesFrom( __DIR__ . '/../../routes/api.php' );
        // });

        if ( $this->app->runningInConsole() ) {
            $this->commands([
                InstallCommand::class,
                ExtractTranslation::class
            ]);
        }

        Blade::directive( 'nsvite', new NsViteDirective );
        Blade::component( 'session-message', SessionMessage::class );

        Event::listen( ApiRouteLoadedEvent::class, function() {
            Route::prefix( 'api' )->group( function() {
                $this->loadRoutesFrom( __DIR__ . '/../../routes/api.php' );
            });
        });
    }
}