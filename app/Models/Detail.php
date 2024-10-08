<?php

namespace App\Models;

use App\Traits\GeneratesSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Detail extends Model
{
    use HasFactory, GeneratesSlug;

    protected $table = 'details';

    protected $fillable = ['name', 'slug',  'is_active'];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Relaciones
    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class);
    }


}
