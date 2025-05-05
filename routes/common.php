<?php

use Ns\Http\Controllers\DashboardController;
use Ns\Http\Middleware\NsRestrictMiddleware;
use Illuminate\Support\Facades\Route;

Route::get( '', [ DashboardController::class, 'home' ] )->name( ns()->routeName( 'ns.dashboard.home' ) )
    ->middleware( [ NsRestrictMiddleware::arguments( 'read.dashboard' )] );

include dirname( __FILE__ ) . '/web/medias.php';
include dirname( __FILE__ ) . '/web/settings.php';
