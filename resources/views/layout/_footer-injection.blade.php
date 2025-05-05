<?php

use Ns\Classes\Output;
use Ns\Events\RenderFooterEvent;

echo Output::dispatch( 
    RenderFooterEvent::class, 
    request()->route()->getName() 
);