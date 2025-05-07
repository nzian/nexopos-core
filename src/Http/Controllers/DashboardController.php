<?php

/**
 * NexoPOS Controller
 *
 * @since  1.0
 **/

namespace Ns\Http\Controllers;

use Ns\Services\DateService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function __construct(
        protected DateService $dateService
    ) {
        // ...
    }

    public function home()
    {
        return View::make( 'ns::pages.dashboard.home', [
            'title' => __( 'Dashboard' ),
        ] );
    }
}
