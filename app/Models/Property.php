<?php

namespace App\Models;

use App\Traits\GeneratesSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    use HasFactory, GeneratesSlug;

    protected  $guarded = [];

    protected $table = 'properties';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //cast
    protected $casts = [
        'images' => 'array',
        'docs' => 'array'
    ];

    public function setImagesAttribute($value)
    {
        $this->attributes['images'] = json_encode($value);
    }




    //Relaciones
    public function asesor(): BelongsTo
    {
        return $this->belongsTo(Asesor::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function clasification(): BelongsTo
    {
        return $this->belongsTo(Clasification::class);
    }

    public function deal(): BelongsTo
    {
        return $this->belongsTo(Deal::class);
    }


    //Relacion muchos a muchos con la tabla Details
    public function details(): BelongsToMany
    {
        return $this->belongsToMany(Detail::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    //Relacion muchos a muchos con la tabla Tags
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }


}
