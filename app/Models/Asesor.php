<?php

namespace App\Models;

use App\Traits\GeneratesSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


// Asesor Model
class Asesor extends Model
{
    use HasFactory, GeneratesSlug;

    protected $table = 'asesors';

    protected $fillable = [
        'name',
        'last_name',
        'slug',
        'email',
        'phone',
        'avatar',
        'is_active',
    ];

    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->last_name;
    }

    //Relaciones
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }
}
