<?php

namespace Ns\Events;

use Ns\Models\ProcurementProduct;
use Illuminate\Queue\SerializesModels;

class ProcurementAfterUpdateProductEvent
{
    use SerializesModels;

    public function __construct( public ProcurementProduct $product, public $fields )
    {
        // ...
    }
}
