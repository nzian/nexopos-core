<?php

namespace Ns\Providers;

use Ns\Services\WidgetService;
use Illuminate\Support\ServiceProvider;

class WidgetsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /**
         * @var WidgetService $widgetService
         */
        $widgetService = app()->make( WidgetService::class );

        $widgetService->bootWidgetsAreas();
    }
}
