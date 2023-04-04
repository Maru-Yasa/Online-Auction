<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\Log;

class ItemObserver
{
    private $model = 'App\Models\Item';
    /**
     * Handle the Item "created" event.
     */
    public function created(Item $item): void
    {
        Log::create([
            'user_id' => auth()->user()->id,
            'model' => $this->model,
            'action' => 'create',
            'text' => 'Item '. $item->name .' created'
        ]);
    }

    /**
     * Handle the Item "updated" event.
     */
    public function updated(Item $item): void
    {
        Log::create([
            'user_id' => auth()->user()->id,
            'model' => $this->model,
            'action' => 'updated',
            'text' => 'Item '. $item->name .' updated'
        ]);
    }

    /**
     * Handle the Item "deleted" event.
     */
    public function deleted(Item $item): void
    {
        Log::create([
            'user_id' => auth()->user()->id,
            'model' => $this->model,
            'action' => 'deleted',
            'text' => 'Item '. $item->name .' deleted'
        ]);
    }

    /**
     * Handle the Item "restored" event.
     */
    public function restored(Item $item): void
    {
        //
    }

    /**
     * Handle the Item "force deleted" event.
     */
    public function forceDeleted(Item $item): void
    {
        //
    }
}
