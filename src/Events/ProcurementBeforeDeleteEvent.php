<?php

namespace Ns\Events;

use Ns\Models\Procurement;
use Illuminate\Queue\SerializesModels;

class ProcurementBeforeDeleteEvent
{
    use SerializesModels;

    public function __construct( public Procurement $procurement )
    {
        // ...
    }
}
