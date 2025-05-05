<?php

namespace Ns\Http\Middleware;

use Ns\Events\InstalledStateBeforeCheckedEvent;
use Ns\Services\Helper;
use Closure;

class InstalledStateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        InstalledStateBeforeCheckedEvent::dispatch( $next, $request );

        if ( Helper::installed() ) {
            return $next( $request );
        }

        return redirect()->route( 'ns.do-setup' );
    }
}
