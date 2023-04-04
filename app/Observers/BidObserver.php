<?php

namespace App\Observers;

use App\Models\Bid;
use App\Models\Log;

class BidObserver
{
    private $model = 'App\Models\Bid';
    /**
     * Handle the Bid "created" event.
     */
    public function created(Bid $bid): void
    {
        Log::create([
            'user_id' => auth()->user()->id,
            'model' => $this->model,
            'action' => 'create',
            'text' => 'Bid placed Rp.'.$bid->offer.' in '.$bid->auction->item->name
        ]);
    }

    /**
     * Handle the Bid "updated" event.
     */
    public function updated(Bid $bid): void
    {
        //
    }

    /**
     * Handle the Bid "deleted" event.
     */
    public function deleted(Bid $bid): void
    {
        //
    }

    /**
     * Handle the Bid "restored" event.
     */
    public function restored(Bid $bid): void
    {
        //
    }

    /**
     * Handle the Bid "force deleted" event.
     */
    public function forceDeleted(Bid $bid): void
    {
        //
    }
}
