<?php
use Ns\Services\DateService;
use Ns\Services\MenuService;
use Illuminate\Support\Facades\Auth;

/**
 * @var MenuService $menus
 */
$menus  =   app()->make( MenuService::class );

/**
 * @var MenuService $menus
 */
$dateService  =   app()->make( DateService::class );

if ( Auth::check() ) {
    $theme  =   Auth::user()->attribute->theme ?: ns()->option->get( 'ns_default_theme', 'light' );
} else {
    $theme  =   ns()->option->get( 'ns_default_theme', 'light' );
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="{{ $theme }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Ns\Services\Helper::pageTitle( $title ?? __( 'Unamed Page' ) ) }}</title>
    @include( 'ns::layout._header-injection')
    @nsvite([
        'resources/scss/line-awesome/1.3.0/scss/line-awesome.scss',
        'resources/css/animations.css',
        'resources/css/fonts.css',
        'resources/css/' . $theme . '.css'
    ])
    @yield( 'layout.dashboard.header' )
    @include( 'ns::layout._header-script' )
    @nsvite([ 'resources/ts/lang-loader.ts' ])
</head>
<body <?php echo in_array( app()->getLocale(), config( 'nexopos.rtl-languages' ) ) ? 'dir="rtl"' : "";?>>
    <div class="h-full w-full flex flex-col">
        <div class="overflow-hidden flex flex-auto">
            <div id="dashboard-aside">
                <div v-if="sidebar === 'visible'" class="w-64 z-50 absolute md:static flex-shrink-0 h-full flex-col overflow-hidden">
                    <div class="ns-scrollbar overflow-y-auto h-full text-sm">
                        <div class="logo py-4 flex justify-center items-center">
                            @if ( ns()->option->get( 'ns_store_rectangle_logo' ) )
                            <img src="{{ ns()->option->get( 'ns_store_rectangle_logo' ) }}" class="w-11/12" alt="logo"/>
                            @else
                            <h1 class="brand-name">NexoPOS</h1>
                            @endif
                        </div>
                        <ul id="aside-menu">
                            @foreach( $menus->getMenus() as $identifier => $menu )
                                <ns-menu identifier="{{ $identifier }}" toggled="{{ $menu[ 'toggled' ] ?? '' }}" label="{{ @$menu[ 'label' ] }}" icon="{{ @$menu[ 'icon' ] }}" href="{{ @$menu[ 'href' ] }}" notification="{{ isset( $menu[ 'notification' ] ) ? $menu[ 'notification' ] : 0 }}" id="menu-{{ $identifier }}">
                                    @if ( isset( $menu[ 'childrens' ] ) )
                                        @foreach( $menu[ 'childrens' ] as $identifier => $menu )
                                        <ns-submenu :active="{{ ( isset( $menu[ 'active' ] ) ? ( $menu[ 'active' ] ? 'true' : 'false' ) : 'false' ) }}" href="{{ $menu[ 'href' ] }}" id="submenu-{{ $identifier }}">{{ $menu[ 'label' ] }}</ns-submenu>
                                        @endforeach        
                                    @endif
                                </ns-menu>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div id="dashboard-overlay">
                <div v-if="sidebar === 'visible'" @click="closeMenu()" class="z-40 w-full h-full md:hidden absolute" style="background: rgb(51 51 51 / 25%)"></div>
            </div>
            <div id="dashboard-body" class="flex flex-auto flex-col overflow-hidden">
                <div class="overflow-y-auto flex-auto">
                    @hassection( 'layout.dashboard.body' )
                        @yield( 'layout.dashboard.body' )
                    @endif

                    @hassection( 'layout.dashboard.body.with-header' )
                        @include( 'ns::common.dashboard.with-header' )
                    @endif

                    @hassection( 'layout.dashboard.with-header' )
                        @include( 'ns::common.dashboard.with-header' )
                    @endif

                    @hassection( 'layout.dashboard.body.with-title' )
                        @include( 'ns::common.dashboard.with-title' )
                    @endif

                    @hassection( 'layout.dashboard.with-title' )
                        @include( 'ns::common.dashboard.with-title' )
                    @endif
                </div>
                <div class="p-2 text-xs flex justify-end text-gray-500">
                    {!! Hook::filter( 'ns-footer-signature', sprintf( __( 'You\'re using <a tager="_blank" href="%s" class="hover:text-blue-400 mx-1 inline-block">NexoPOS %s</a>' ), 'https://my.nexopos.com/en', config( 'nexopos.version' ) ) ) !!}
                </div>
            </div>
        </div>
    </div>
    @section( 'layout.dashboard.footer' )
        @include( 'ns::common.popups' )
        @include( 'ns::common.dashboard-footer' )
        @nsvite([ 'resources/ts/app.ts' ])
    @show
</body>
</html>
