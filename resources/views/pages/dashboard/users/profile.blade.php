<?php
use Ns\Classes\Hook;
use Ns\Classes\Output;
use Ns\Events\RenderProfileFooterEvent;
?>
@extends( 'ns::layout.dashboard' )

@section( 'layout.dashboard.body' )
<div class="flex-auto flex flex-col">
    @include( Hook::filter( 'ns-dashboard-header-file', 'ns::common/dashboard-header' ) )
    <div class="px-4 flex flex-col" id="dashboard-content">
        @include( 'ns::common.dashboard.title' )
        <div>
            <ns-settings
                url="{{ $src ?? '#' }}"
                submit-url="{{ $submitUrl }}">
            </ns-settings>
        </div>
    </div>
</div>
@endsection

@section( 'layout.dashboard.footer' )
    @parent
    <?php echo Output::dispatch( RenderProfileFooterEvent::class ); ?>
@endsection