<?php
namespace Ns\Providers;

use Illuminate\Support\ServiceProvider;
use Ns\Services\CoreService;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(  )
    {
        // $coreService->registerGatePermissions();
    }

    public function register()
    {
        // ...
    }
}