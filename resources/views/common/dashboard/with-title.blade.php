<?php
use App\Classes\Hook;
?>
<div>
    @include( Hook::filter( 'ns-dashboard-header-file', 'ns::common/dashboard-header' ) )
    <div id="dashboard-content" class="px-4">
        @include( 'ns::common.dashboard.title' )
        @yield( 'layout.dashboard.body.with-title' )
        @yield( 'layout.dashboard.with-title' )
    </div>
</div>