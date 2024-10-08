<?php

namespace App\Models;

use App\Traits\GeneratesSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    use HasFactory, GeneratesSlug;

    protected $table = 'types';

    protected $fillable = ['name', 'slug', 'is_active', 'clasification_id'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    //Relaciones
//    public function clasification(): BelongsTo
//    {
//        return $this->belongsTo(Clasification::class);
//    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

}
