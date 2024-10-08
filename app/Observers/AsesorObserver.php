<?php

namespace App\Observers;

use App\Models\Asesor;
use Illuminate\Support\Facades\Storage;

class AsesorObserver
{
    /**
     * Handle the Asesor "created" event.
     */
    public function created(Asesor $asesor): void
    {
        //
    }

    /**
     * Handle the Asesor "updated" event.
     */
    public function updated(Asesor $asesor): void
    {
        if($asesor->isDirty('avatar')){
            Storage::disk('public')->delete($asesor->getOriginal('avatar'));
        }
    }

    /**
     * Handle the Asesor "deleted" event.
     */
    public function deleted(Asesor $asesor): void
    {
        if(! is_null($asesor->avatar)){
            Storage::disk('public')->delete($asesor->avatar);
        }
    }

    /**
     * Handle the Asesor "restored" event.
     */
    public function restored(Asesor $asesor): void
    {
        //
    }

    /**
     * Handle the Asesor "force deleted" event.
     */
    public function forceDeleted(Asesor $asesor): void
    {
        //
    }
}
