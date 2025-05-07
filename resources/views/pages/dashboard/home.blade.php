<?php
use Ns\Classes\Hook;
use Ns\Classes\Output;
?>
@extends( 'ns::layout.dashboard' )

@section( 'layout.dashboard.body' )
    <div>
        @include( Hook::filter( 'ns-dashboard-header-file', 'ns::common/dashboard-header' ) )
        @include( 'ns::pages.dashboard.store-dashboard' )
    </div>
@endsection

@section( 'layout.dashboard.footer.inject' )
    @nsvite([ 'resources/ts/widgets.ts' ])
@endsection