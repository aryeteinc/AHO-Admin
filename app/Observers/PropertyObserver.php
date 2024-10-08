<?php

namespace App\Observers;

use App\Models\Property;
use Illuminate\Support\Facades\Storage;

class PropertyObserver
{
    /**
     * Handle the Property "created" event.
     */
    public function created(Property $property): void
    {
        // Code to handle the "created" event
    }

    /**
     * Handle the Property "updated" event.
     */
    public function updated(Property $property): void
    {
        //Si ya existen imágenes en el campo images, se deben eliminar del disco
        $imagesToDelete = array_diff($property->getOriginal('images'), $property->images);
        foreach ($imagesToDelete as $image) {
            Storage::disk('public')->delete($image);
        }
    }

    /**
     * Handle the Property "deleted" event.
     */
    public function deleted(Property $property): void
    {
        //El campo images es un campo json, por lo que se debe eliminar cada imagen del disco
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image);
        }
    }

    /**
     * Handle the Property "restored" event.
     */
    public function restored(Property $property): void
    {
        // Code to handle the "restored" event
    }

    /**
     * Handle the Property "force deleted" event.
     */
    public function forceDeleted(Property $property): void
    {
        // Code to handle the "force deleted" event
    }
}
