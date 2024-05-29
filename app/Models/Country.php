<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Country extends Model
{
    use HasFactory;
    use Searchable;
    use HasSlug;

    protected $fillable = ['title', 'slug'];

    protected $searchableFields = ['*'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
