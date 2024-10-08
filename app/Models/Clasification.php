<?php

namespace App\Models;

use App\Traits\GeneratesSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clasification extends Model
{
    use HasFactory, GeneratesSlug;

    protected $table = 'clasifications';

    protected $fillable = ['name', 'is_active', 'type_id'];

    public function getRouteKeyName(): ?string
    {
        return 'slug';
    }



    //Relaciones
//    public function type(): HasMany
//    {
//        return $this->hasMany(Type::class);
//    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }


}
