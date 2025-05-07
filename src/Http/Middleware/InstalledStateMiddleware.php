<?php

namespace Ns\Http\Middleware;

use Ns\Events\InstalledStateBeforeCheckedEvent;
use Ns\Services\Helper;
use Closure;
use Ns\Models\Role;

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

        /**
         * We'll also check if there is at least
         * and administrator. If he's deleted, it will be required to create a new one.
         */
        $totalAdmins    =   Role::withNamespace( Role::ADMIN )->whereHas( 'users' )->count();

        if ( Helper::installed() && $totalAdmins > 0 ) {
            return $next( $request );
        }

        return redirect()->route( 'ns.do-setup' );
    }
}
