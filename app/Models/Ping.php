<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ping extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'pingable_id',
        'pingable_type',
        'date_start',
        'date_end',
        'note',
        'is_active',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function pingable()
    {
        return $this->morphTo();
    }
}
