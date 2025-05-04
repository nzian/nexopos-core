<?php

namespace Ns\Traits;

use Ns\Events\JobBeforeSerializeEvent;
use Ns\Jobs\Middleware\UnserializeMiddleware;
use Modules\NsMultiStore\Models\Store;

trait NsSerialize
{
    public $attributes;

    public Store $store;

    protected function prepareSerialization()
    {
        JobBeforeSerializeEvent::dispatch( $this );
    }

    public function middleware()
    {
        return [
            UnserializeMiddleware::class,
        ];
    }
}
