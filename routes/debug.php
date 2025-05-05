<?php

use dekor\ArrayToTextTable;
use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

if ( env( 'APP_DEBUG' ) ) {
    Route::get( '/routes', function () {
        $values = collect( array_values( (array) app( 'router' )->getRoutes() )[1] )->map( function ( RoutingRoute $route ) {
            return [
                'domain' => $route->getDomain(),
                'uri' => $route->uri(),
                'methods' => collect( $route->methods() )->join( ', ' ),
                'name' => $route->getName(),
            ];
        } )->values();

        return ( new ArrayToTextTable( $values->toArray() ) )->render();
    } );

    Route::get( '/exceptions', function ( Request $request ) {
        $class = $request->input( 'class' );
        $exceptions = [
            \Ns\Exceptions\CoreException::class,
            \Ns\Exceptions\CoreVersionMismatchException::class,
            \Ns\Exceptions\MethodNotAllowedHttpException::class,
            \Ns\Exceptions\MissingDependencyException::class,
            \Ns\Exceptions\ModuleVersionMismatchException::class,
            \Ns\Exceptions\NotAllowedException::class,
            \Ns\Exceptions\NotFoundException::class,
            \Ns\Exceptions\QueryException::class,
            \Ns\Exceptions\ValidationException::class,
        ];

        if ( in_array( $class, $exceptions ) ) {
            throw new $class;
        }

        return abort( 404, 'Exception not found.' );
    } );
}
