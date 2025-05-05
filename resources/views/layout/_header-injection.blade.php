<?php

use Ns\Classes\Output;
use Ns\Events\RenderHeaderEvent;

echo Output::dispatch( 
    RenderHeaderEvent::class, 
    request()->route()->getName() 
);