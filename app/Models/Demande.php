<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demande extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['user_id', 'demandeable_id', 'demandeable_type'];

    protected $searchableFields = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function demandeable()
    {
        return $this->morphTo();
    }
}
