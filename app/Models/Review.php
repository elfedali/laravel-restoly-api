<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'user_id',
        'reviewable_id',
        'reviewable_type',
        'content',
        'rating',
    ];

    protected $searchableFields = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewable()
    {
        return $this->morphTo();
    }
}
