<?php

namespace Ns\Events;

use Ns\Models\Order;
use Ns\Models\OrderProduct;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderBeforeDeleteProductEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct( public Order $order, public OrderProduct $orderProduct )
    {
        // ...
    }
}
