<?php

namespace Ns\Events;

use Ns\Models\TransactionHistory;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TransactionsHistoryBeforeDeleteEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( public TransactionHistory $transactionHistory )
    {
        // ...
    }
}
