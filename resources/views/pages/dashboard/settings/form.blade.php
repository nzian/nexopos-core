<?php

use Ns\Classes\Output;
use Ns\Events\RenderSettingsFooterEvent;

?>
@extends( 'ns::layout.dashboard' )

@section( 'layout.dashboard.body' )
<div>
    @include( Hook::filter( 'ns-dashboard-header-file', 'ns::common/dashboard-header' ) )
    <div class="px-4 flex flex-col" id="dashboard-content">
        <div class="flex-auto flex flex-col">
            @include( 'ns::common.dashboard.title' )
        </div>
        <div>
            <ns-settings
                url="{{ nsUrl( '/api/settings/' . $identifier ) }}">
            </ns-settings>
        </div>
    </div>
</div>
@endsection

@section( 'layout.dashboard.footer' )
    @parent
    <?php echo Output::dispatch( RenderSettingsFooterEvent::class, $instance );?>
@endsection