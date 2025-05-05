<?php

use Ns\Models\UserAttribute;
use Illuminate\Support\Facades\Auth;

if ( Auth::check() && Auth::user()->attribute instanceof UserAttribute ) {
    $theme  =   Auth::user()->attribute->theme ?: ns()->option->get( 'ns_default_theme', 'light' );
} else {
    $theme  =   ns()->option->get( 'ns_default_theme', 'light' );
}
?>

@inject( 'dateService', 'Ns\Services\DateService' )
<!DOCTYPE html>
<html lang="en" data-theme="{{ $theme }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{!! $title ?? __( 'Unamed Page' ) !!}</title>
    @include( 'ns::layout._header-injection' )
    @nsvite([
        'resources/scss/line-awesome/1.3.0/scss/line-awesome.scss',
        'resources/css/grid.css',
        'resources/css/fonts.css',
        'resources/css/animations.css',
        'resources/css/' . $theme . '.css'
    ])
    @yield( 'layout.base.header' )
    @include( 'ns::layout._header-script' )
    @nsvite([ 'resources/ts/lang-loader.ts' ])
</head>
<body>
    @yield( 'layout.base.body' )
    @section( 'layout.base.footer' )
        @include( 'ns::common.footer' )
    @show
</body>
</html>
