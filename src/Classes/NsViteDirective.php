<?php
namespace Ns\Classes;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;

class NsViteDirective
{
    public function __invoke( $expression )
    {
        return View::make( 'ns::vite', compact( 'expression'  ) )->render();
    }
}