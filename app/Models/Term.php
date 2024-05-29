<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Term extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['title', 'slug', 'taxonomy_id'];

    protected $searchableFields = ['*'];

    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class);
    }

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }
}
