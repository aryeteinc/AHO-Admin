<?php

namespace App\Models;

use App\Traits\GeneratesSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class City extends Model
{
    use HasFactory, GeneratesSlug;

    protected $table = 'cities';

    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'department_id',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    // Event to generate slug


    //Relationships

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

}
