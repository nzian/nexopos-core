<?php
namespace Ns\Classes;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;

class NsViteDirective
{
    public function __invoke( $expression )
    {
        $content = file_get_contents( __DIR__ . '/../../resources/views/vite.blade.php' );
        $content = str_replace( "'{{ expression }}'", $expression, $content );
        return $content;
    }
}