<?php

namespace App\Models;

use App\Traits\GeneratesSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory, generatesSlug;

    protected $table = 'tags';

    protected $fillable = ['name', 'slug', 'color'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    //Relacion muchos a muchos con la tabla Properties
    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class);
    }

}
