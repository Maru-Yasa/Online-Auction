<?php

namespace App\Observers;

use App\Models\Auction;
use App\Models\Log;

class AuctionObserver
{
    private $model = 'App\Models\Auction';
    /**
     * Handle the Auction "created" event.
     */
    public function created(Auction $auction): void
    {
        // Log::create([
        //     'user_id' => auth()->user()->id,
        //     'model' => $this->model,
        //     'action' => 'create',
        //     'text' => 'Auction '. $auction->name .' created'
        // ]);
    }

    /**
     * Handle the Auction "updated" event.
     */
    public function updated(Auction $auction): void
    {
        Log::create([
            'user_id' => auth()->user()->id,
            'model' => $this->model,
            'action' => 'updated',
            'text' => 'Auction '.$auction->item->name.' '. $auction->status
        ]);
    }

    /**
     * Handle the Auction "deleted" event.
     */
    public function deleted(Auction $auction): void
    {
        //
    }

    /**
     * Handle the Auction "restored" event.
     */
    public function restored(Auction $auction): void
    {
        //
    }

    /**
     * Handle the Auction "force deleted" event.
     */
    public function forceDeleted(Auction $auction): void
    {
        //
    }
}
