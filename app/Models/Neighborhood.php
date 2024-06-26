<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Neighborhood extends Model
{
    use HasFactory;
    use Searchable;
    use HasSlug;

    protected $fillable = ['title', 'slug', 'city_id'];


    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    protected $searchableFields = ['*'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
