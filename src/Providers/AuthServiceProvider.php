<?php
namespace Ns\Providers;

use Ns\Services\CoreService;

class AuthServiceProvider
{
    public function boot( CoreService $coreService )
    {
        $coreService->registerGatePermissions();
    }
}