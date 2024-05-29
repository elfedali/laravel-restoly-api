<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'price',
        'price_promo',
        'date_start',
        'date_end',
        'promotionable_id',
        'promotionable_type',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
    ];

    public function promotionable()
    {
        return $this->morphTo();
    }
}
