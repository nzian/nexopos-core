<?php

namespace Ns\Events;

use Ns\Models\Procurement;
use Illuminate\Queue\SerializesModels;

class ProcurementAfterDeleteProductEvent
{
    use SerializesModels;

    public function __construct( public $product_id, public Procurement $procurement )
    {
        // ...
    }
}
