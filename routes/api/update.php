<?php

use Ns\Http\Controllers\UpdateController;
use Ns\Http\Middleware\Authenticate;
use Ns\Http\Middleware\CheckMigrationStatus;
use Illuminate\Support\Facades\Route;

Route::post( 'update', [ UpdateController::class, 'runMigration' ] )
    ->withoutMiddleware( [ Authenticate::class, CheckMigrationStatus::class ] );
