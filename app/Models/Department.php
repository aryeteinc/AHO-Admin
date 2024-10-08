<?php

namespace App\Models;

use App\Traits\GeneratesSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;
    use GeneratesSlug;

    protected $table = 'departments';

    protected $fillable = [
        'name',
        'slug',
        'is_active',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Event to generate slug
//    protected static function boot(): void
//    {
//        parent::boot();
//
//        static::creating(function ($department) {
//            if (empty($department->slug)) {
//                $department->slug = Str::slug($department->name);
//            }
//        });
//    }

    //Relationships

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }


}
