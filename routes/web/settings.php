<?php

use Ns\Http\Controllers\Dashboard\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get( '/settings/{settings}', [ SettingsController::class, 'getSettings' ] )->name( nsRouteName( 'ns.dashboard.settings' ) );
