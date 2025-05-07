@extends( 'ns::layout.dashboard' )

@section( 'layout.dashboard.body' )
<div class="flex-auto flex flex-col">
    @include( Hook::filter( 'ns-dashboard-header-file', 'ns::common/dashboard-header' ) )
    <div class="px-4 flex flex-col" id="dashboard-content">
        <div class="flex-auto flex flex-col">
        @include( 'ns::common.dashboard.title' )
        </div>
        <div>
            <ns-settings
                url="{{ nsUrl( '/api/settings/ns.notifications' ) }}">
            </ns-settings>
        </div>
    </div>
</div>
@endsection