<?php

namespace Ns\Events;

use Ns\Models\Order;
use Ns\Models\OrderProduct;
use Ns\Models\OrderProductRefund;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderAfterProductRefundedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct( public Order $order, public OrderProduct $orderProduct, public OrderProductRefund $orderProductRefund )
    {
        // ...
    }
}
