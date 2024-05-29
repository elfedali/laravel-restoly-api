<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meta extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['metaable_id', 'metaable_type', 'meta_key'];

    protected $searchableFields = ['*'];

    public function metaable()
    {
        return $this->morphTo();
    }
}
