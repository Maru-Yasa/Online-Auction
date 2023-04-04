<?php

namespace App\Observers;

use App\Models\Log;
use App\Models\User;

class UserObserver
{
    private $model = 'App\Models\User';
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        if (auth()->user()) {
            Log::create([
                'user_id' => auth()->user()->id,
                'model' => $this->model,
                'action' => 'create',
                'text' => 'User '. $user->username .' created'
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        Log::create([
            'user_id' => auth()->user()->id,
            'model' => $this->model,
            'action' => 'update',
            'text' => 'User '. $user->username .' updated'
        ]);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        Log::create([
            'user_id' => auth()->user()->id,
            'model' => $this->model,
            'action' => 'delete',
            'text' => 'User '. $user->username .' deleted'
        ]);
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
