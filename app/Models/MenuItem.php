<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuItem extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'menu_id',
        'title',
        'ingredients',
        'price',
        'is_disponible',
        'is_vegetarian',
        'picture',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'menu_items';

    protected $casts = [
        'is_disponible' => 'boolean',
        'is_vegetarian' => 'boolean',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function promotions()
    {
        return $this->morphMany(Promotion::class, 'promotionable');
    }
}
