<?php

/**
 * NexoPOS Controller
 *
 * @since  1.0
 **/

namespace Ns\Http\Controllers\Dashboard;

use Ns\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\View;

class HomeController extends DashboardController
{
    public function welcome()
    {
        return View::make( 'welcome', [
            'title' => sprintf(
                __( 'Welcome — %s' ),
                ns()->option->get( 'ns_store_name', 'NexoPOS ' . config( 'nexopos.version' ) )
            ),
        ] );
    }
}
