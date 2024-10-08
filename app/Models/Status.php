<?php

namespace App\Models;

use App\Traits\GeneratesSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory, GeneratesSlug;

    protected $fillable = ['name', 'slug'];

    protected $table = 'statuses';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Relaciones
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
