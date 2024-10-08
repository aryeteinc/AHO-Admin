<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deal extends Model
{

    use HasFactory;

    protected $table = 'deals';

    protected $fillable = ['name', 'slug', 'is_active'];

    public function getRouteKeyName(): ?string
    {
        return 'slug';
    }

    //Relaciones
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

}
