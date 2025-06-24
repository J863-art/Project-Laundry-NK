<?php

namespace App\Observers;

use App\Models\Pesanann;

class PesananObserver
{
    /**
     * Handle the Pesanann "created" event.
     */
    public function created(Pesanann $pesanann): void
    {
        //
    }

    /**
     * Handle the Pesanann "updated" event.
     */
    public function updated(Pesanann $pesanann): void
    {
        //
    }

    /**
     * Handle the Pesanann "deleted" event.
     */
    public function deleted(Pesanann $pesanann): void
    {
        //
    }

    /**
     * Handle the Pesanann "restored" event.
     */
    public function restored(Pesanann $pesanann): void
    {
        //
    }

    /**
     * Handle the Pesanann "force deleted" event.
     */
    public function forceDeleted(Pesanann $pesanann): void
    {
        //
    }
}
