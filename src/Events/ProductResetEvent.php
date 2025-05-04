<?php

namespace Ns\Events;

use Ns\Models\Product;
use Illuminate\Queue\SerializesModels;

class ProductResetEvent
{
    use SerializesModels;

    public function __construct( public Product $product )
    {
        // ...
    }
}
